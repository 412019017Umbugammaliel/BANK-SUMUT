// Set Active or Nonactive Two-Factor Auth ====================================

$(document).on('click','#register_phoneNumbers', function(){
    $.ajax({
        url: base_url+"/Home/",
        type: 'POST',
        success: function(response) {
            
        }
    })
})
$(document).on('click','#register_emailAddress', function(){
    $.ajax({
        url: base_url+"/Home/",
        type: 'POST',
        success: function(response) {

        }
    })

})


// ============================================================================