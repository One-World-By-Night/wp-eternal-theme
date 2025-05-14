jQuery(document).ready(function () {
    if(customAdminData.user_role){
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        const pageValue = url.searchParams.get("page");
        console.log(pageValue,"pageValue")
        if (pageValue == "tablepress") {
            var c = 0;
        jQuery('#the-list tr').each(function(){
            const author_name = jQuery(this).find('.column-table_author').html();
            if(customAdminData.display_name!==author_name){
                jQuery(this).css("display","none");
            }else{
                c++;
                jQuery('.displaying-num').html(c+" tables");
            }
            if(c==0){
                jQuery('.displaying-num').html(0+" tables");
            }
        });
        }
    }
});
