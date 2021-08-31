/**
	Title
**/
jQuery( document ).on( 'elementor/popup/show', (event, popId) => {

	//reinitiate elementor settings to load
	let dateSettings = {minDate:0, changeMonth: true, changeYear: true, }; 
	jQuery('.datepicker').removeClass('hasDatepicker').datepicker(dateSettings);
});