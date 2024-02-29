// JavaScript Document
jQuery(document).ready(function($) {
    gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
        if ( formId == 24 && fieldId == 19 ) {
            console.log('Date picker : initialisation');
            // Obtenir la date du jour
            var today = new Date();
            // Définir $dateMin sur la date actuelle
            var dateMin = today;
            // Définir $dateMax sur la date actuelle + 3 ans
            var dateMax = new Date(today.getFullYear() + 3, today.getMonth(), today.getDate());

            var ranges = [
                { start: dateMin, end: dateMax },
            ];
            optionsObj.beforeShowDay = function(date) {
                for ( var i=0; i<ranges.length; i++ ) {
                    if ( date >= ranges[i].start && date <= ranges[i].end ) return [true, ''];
                }
                return [false, ''];
            };
            optionsObj.minDate = ranges[0].start;
            optionsObj.maxDate = ranges[ranges.length -1].end;
        }
        return optionsObj;
    });
});
