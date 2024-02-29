((($) => {
    const SELECTORS = {
        region: ".package_region select",
        type: ".package_type select",
        group: ".package_group select",
        package: ".packages select",
    };

    const CURRENT_POST_EL = "#current-post";
    const DYNAMIC_POST_EL = "#dynamic-post";
    const swiperEl = '#package-slider';
    const GF_POST_RENDER_EVENT = 'gform_post_render';
    const PACKAGE_SELECTOR = 'PackageSelector';
    const VIMEO_SRC_TEMPLATE = "https://player.vimeo.com/video/{0}?h=db57139e05&badge=0&autopause=0&player_id=0&background=1&muted=1";

    class PackageSelector {
        constructor(postData) {
            this.swiper = false;
            this.packages = JSON.parse(postData.packages);
            this.taxonomies = JSON.parse(postData.taxonomies);
            this.defaultSettings = JSON.parse(postData.defaultSettings);
            this.defaultSelected = postData.selected;
            this.adminUrl = postData.admin_url;
            this.removedOptions = [];
            this.selectors = this.cacheSelectors();
            this.isFront = postData.isFront;
            this.setDefaultSelected();
            this.selectedOptions = this.getSelectedOptions();
            this.homeUrl = postData.home_url;
            this.initEventListeners();


        }

        setDefaultSelected() {
            this.selectors.region.val(this.defaultSelected.package_region);
            this.selectors.type.val(this.defaultSelected.package_type);
            this.selectors.group.val(this.defaultSelected.package_group);
            this.selectors.package.val(this.defaultSelected.destination);

            this.updatePackagesList();
        }

        cacheSelectors() {
            const selectors = {};
            for (let key in SELECTORS) {
                selectors[key] = $(SELECTORS[key]);
            }
            selectors.packageOptions = selectors.package.children();

            return selectors;
        }

        initEventListeners() {
            ['region', 'type', 'group', 'package'].forEach(name => {
                this.selectors[name].on("change", $.proxy(this.updatePackage, this, name));
            });
        }


        checkMatches(taxonomiesTerms, packageTaxonomies) {
            return taxonomiesTerms.every(({taxonomy, terms}) => {
                const packageTerms = packageTaxonomies[taxonomy];
                return Array.isArray(packageTerms) && packageTerms.some((term) => terms.includes(term));
            });
        }

        getSelectedOptions() {
            let packageStringFormatted = this.selectors.package.val().split("|")[0];
            const selectedOptions = {
                region: this.taxonomies.package_region.terms[this.selectors.region.get(0).value],
                type: this.taxonomies.package_type.terms[this.selectors.type.get(0).value],
                group: this.taxonomies.package_group.terms[this.selectors.group.get(0).value],
                package: this.packages[packageStringFormatted],
            };

            return selectedOptions;
        }

        getSelectedTaxonomiesTerms() {
            const selectedTaxonomies = {
                package_region: this.selectors.region.val(),
                package_type: this.selectors.type.val(),
                package_group: this.selectors.group.val(),
            };

            return Object.entries(selectedTaxonomies)
                .filter(([, terms]) => terms.length > 0)
                .map(([taxonomy, terms]) => {
                    return {taxonomy, terms: terms};
                });
        }

        updatePackage(type) {
            if (type !== 'package') {
                this.selectedOptions.package = null;
                this.selectors.package.val('');
            }

            this.selectedOptions = this.getSelectedOptions();

            this.updatePackagesList();


            let lastSelectedOptionKey = this.getLastSelectedOptionKey();
            this.updateCurrentUrl(lastSelectedOptionKey);


            this.updateView(this.selectedOptions[lastSelectedOptionKey], lastSelectedOptionKey);

        }

        updateCurrentUrl(lastSelectedOptionKey) {
            let newUrl = this.homeUrl + '/';

            Object.values(this.selectedOptions).forEach((option) => {
                if (option) {
                    newUrl += option.permalink + '/';

                    if (lastSelectedOptionKey === 'package') {
                        newUrl = option.permalink;
                    }
                }
            });

            // Update the URL in the browser's history and address bar without causing a page reload
            window.history.pushState({}, '', newUrl);
        }

        getLastSelectedOptionKey() {
            let selectedOptions = this.selectedOptions;
            let lastSelected = null;
            for (const [key, value] of Object.entries(selectedOptions)) {
                if (value) {
                    lastSelected = key;
                }
            }
            return lastSelected;
        }

        updatePackagesList() {
            const taxonomiesTerms = this.getSelectedTaxonomiesTerms();


            let isMatched = false;
            let matchedPackages = [];

            Array.from(this.selectors.packageOptions.slice(1)).forEach((option) => {
                let index = option.value.split("|")[0];
                const pkg = this.packages[index];

                if (!pkg) {
                    return;
                }

                const matches = this.checkMatches(taxonomiesTerms, pkg.taxonomies);
                isMatched = isMatched || matches;

                if (matches) {
                    matchedPackages.push(pkg);
                    if (this.removedOptions.includes(option)) {
                        this.selectors.package.append(option);
                    }
                } else {
                    this.removedOptions.push(option);
                    $(option).remove();
                }
            });

            setTimeout(() => {
                $(".packages").toggleClass("d-none", !isMatched);
            }, 0);

            this.avalaiblePackages = matchedPackages;
        }

        updateView(selectedItem, type) {
            const $dynamicPost = $(DYNAMIC_POST_EL);
            const $currentPost = $(CURRENT_POST_EL);


            if (selectedItem && $dynamicPost.length) {

                $currentPost.hide();
                switch (type) {
                    case 'region':
                        if (selectedItem.id != 21) {
                            selectedItem.slides = this.taxonomies.package_type.terms;
                        }
                        break;
                    case 'type':
                        if (selectedItem.id != 35) {
                            if (selectedItem.id == 24) {
                                selectedItem.slides = this.avalaiblePackages;
                            } else {
                                selectedItem.slides = this.taxonomies.package_group.terms;
                            }
                        }

                        break;
                    case 'group':
                        selectedItem.slides = this.avalaiblePackages;
                        break;
                }

                let html = '';

                $.ajax({
                    type: 'POST',
                    url: this.adminUrl,
                    data: {
                        item: selectedItem,
                        action: 'get_package',
                    },
                    success: function (response) {
                        $dynamicPost.html(response);
                        window.initSlider();


                        console.log(selectedItem);
                        if (selectedItem.leaflet) {

                            window.leafletmap = new LeafletFront(selectedItem);
                      

                            console.log(window.leafletmap)
                        } else {
                            window.leafletmap = false;
                        }
                    },
                    error: function (error) {
                        // Handle any errors here...
                        console.log(error);
                    }
                });

                this.initSwiper();
            } else {
                $dynamicPost.html('');
                $currentPost.show();
                if ($('body').hasClass('home')) {
                    $dynamicPost.find(".package-informations-container").removeClass('current');
                }
            }
        }

        initSwiper() {
            this.swiper = new Swiper(swiperEl, {
                pagination: false,
                navigation: false,
                spaceBetween: 24,
                slidesPerView: 'auto'
            });
        }
    }

    $(document).on(GF_POST_RENDER_EVENT, function (event, formId) {
        if ($(`#gform_${formId}`).find('.packages').length) {
            window[PACKAGE_SELECTOR] = new PackageSelector(postData);
        }

    });
})(jQuery));

