
jQuery(document).ready(function ($) {
    if (forfaitsData && forfaitsData.restrictedDates.length > 0) {


        $.datepicker.setDefaults({

            beforeShowDay: function (date) {
                let dateRestrictedObj = forfaitsData.restrictedDates;

                if (dateRestrictedObj) {
                    let enabledDate = true;
                    let currentDate = new Date(date).getTime();

                    dateRestrictedObj.forEach(dateObj => {
                        let startDate = new Date(dateObj.date_de_debut).getTime();
                        let endDate = new Date(dateObj.date_de_fin).getTime();

                        if (currentDate >= startDate && currentDate <= endDate + 86400000) {
                            enabledDate = false;
                            return false;
                        }
                    });

                    return [enabledDate, '', ''];
                }
            },
        });
    }
});