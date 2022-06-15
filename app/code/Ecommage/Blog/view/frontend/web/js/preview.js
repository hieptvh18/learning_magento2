
require(['jquery'], function($){
    $(document).ready(function(){
        alert('he')
        $('input[name="featured_image"]').on('change',(e)=>{
            var reader = new FileReader();
            reader.onload = function () {
                $("#img-preview").attr('src',reader.result);
            };
            reader.readAsDataURL(event.target.files[0]);
        })
    })
});
