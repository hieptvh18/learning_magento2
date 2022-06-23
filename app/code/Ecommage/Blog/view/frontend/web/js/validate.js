
define(["jquery",'mage/url'],function ($,urlBuilder){
    return function (){
                const url = urlBuilder.build('blog/ajax/validate');
                var title = $('input[name="title"]').val();
                $.ajax({
                    //     form data -> controller ajax
                    url: url,
                    type:'POST',
                    dataType :'json',
                    data:{
                        title:title
                    },
                    success:function(res){
                        if(res.status == 'exist'){
                            $('.erTitleEl').html('Title existed! please again!');
                            $('input[name="title"]').css('border','solid red');
                        }else{
                            // not exist -> submit save blog
                            $('.erTitleEl').html('');
                            $('input[name="title"]').css('border','');
                            document.forms['form-add-blog'].submit();
                        }
                    },
                    error(err){
                        console.log(err)
                    }
                }
        )
    }

})
