$(document).ready( function() {
    $("#menu-content li.active").removeClass("active");
    console.log(window.location.pathname);
    $locationUrl = window.location.pathname;
    console.log($("#menu-content"));
    console.log($("#menu-content li.active"));
    $locationUrl.includes("/dashboard") ? $("li#dashboard").addClass("active") : {} ;
    $locationUrl.includes("/exam") ? $("li#exam").addClass("active") : {} ;
    $locationUrl.includes("/questions") ? $("li#question").addClass("active") : {} ;
});