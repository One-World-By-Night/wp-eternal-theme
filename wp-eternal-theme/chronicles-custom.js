jQuery(document).ready(function(){
//     if (jQuery('.User_chronicleInfo').length > 0) {
// 		alert("55sd5f5sdf");
//         jQuery('.arm_directory_form_top').css('display','none');
//     } else {
//         alert("Hi");
//     }
    
	
	
});

jQuery(window).scroll(function(){
		if(jQuery(window).scrollTop() > 20) {
			jQuery(".main--header").addClass("active");
		}
		else {
			jQuery(".main--header").removeClass("active");
		}
	});



// Genre Feature below

jQuery(document).ready(function() {
  jQuery(".chronicle_shortcode2 select option[value='By Genre']").removeAttr("value");
	jQuery("button.arm_directory_clear_btn").click(function(){
		location.reload();
	});
});

jQuery(document).ready(function() {
    // Create a new option element
    var newOption = jQuery('<p>', {
//         value: '1', // Value of the option
        text: 'Option 1' // Text of the option
    });

    // Prepend the new option to the select input
    jQuery('.arm_dir_filter_input select').prepend(newOption);
});

jQuery(document).ready(function() {
    // Remove the option with the text "By Genre"
    jQuery('#arm_select_hg1K7_2_EPOrCY01Ml option').filter(function() {
        return jQuery(this).text() === 'By Genre';
    }).remove();
});

// jQuery(document).ready(function(){
//     jQuery('#genreDropdown').change(function() {
//         // Reset the form when a genre is selected
//         jQuery('#searchForm')[0].reset();
//     });
// });
