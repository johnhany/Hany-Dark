/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * Toggles search on and off
 */

jQuery(document).ready(function($){
    $(".search-toggle").click(function(){
        $("#search-container").slideToggle('slow', function(){
            $('.search-toggle').toggleClass('active');
        });
        // Optional return false to avoid the page "jumping" when clicked
        return false;
    });
});
