/* 
	author: istockphp.com
*/
jQuery(function($) {
    $("a.topopup").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.save_search").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup1(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.contact_agent").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup2(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.save_propertys").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup3(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.add_property").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup4(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.save_prop_main").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup3(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    $("a.save_search_poup").click(function() {
        loading(); // loading
        setTimeout(function() { // then show popup, deley in .5 second
            loadPopup9(); // function show popup 
        }, 500); // .5 second
        return false;
    });
    /* event for close the popup */
    $("div.close").hover(
        function() {
            $('span.ecs_tooltip').show();
        },
        function() {
            $('span.ecs_tooltip').hide();
        }
    );
    $("div.close").click(function() {
        disablePopup(); // function close pop up
    });
    /*$(this).keyup(function(event) {
    	if (event.which == 27) { // 27 is 'Ecs' in the keyboard
    		disablePopup();  // function close pop up
    	}  	
    });
	
    $("div#backgroundPopup").click(function() {
    	disablePopup();  // function close pop up
    });*/
    $('a.livebox').click(function() {
        alert('Hello World!');
        return false;
    });
    $("div.close1").click(function() {
        disablePopup1(); // function close pop up
    });
    $("div.close2").click(function() {
        disablePopup2(); // function close pop up
    });
    $("div.close3").click(function() {
        disablePopup3(); // function close pop up
    });
    $("div.close4").click(function() {
        disablePopup4(); // function close pop up
    });
    $("div.close9").click(function() {
        disablePopup9(); // function close pop up
    });
    /************** start: functions. **************/
    function loading() {
        $("div.loader").show();
    }
    function closeloading() {
        $("div.loader").fadeOut('normal');
    }
    var popupStatus = 0; // set value
    function loadPopup() {
        if (popupStatus == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup").fadeIn(0500); // fadein popup div
            $("#backgroundPopup").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup").fadeIn(0001);
            popupStatus = 1; // and set value to 1
        }
    }
    function disablePopup() {
        if (popupStatus == 1) { // if value is 1, close popup
            $("#toPopup").fadeOut("normal");
            $("#backgroundPopup").fadeOut("normal");
            popupStatus = 0; // and set value to 0
        }
    }
    var popupStatus1 = 0;
    function loadPopup1() {
        if (popupStatus1 == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup1").fadeIn(0500); // fadein popup div
            $("#backgroundPopup1").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup1").fadeIn(0001);
            popupStatus1 = 1; // and set value to 1
        }
    }
    function disablePopup1() {
        if (popupStatus1 == 1) { // if value is 1, close popup
            $("#toPopup1").fadeOut("normal");
            $("#backgroundPopup1").fadeOut("normal");
            popupStatus1 = 0; // and set value to 0
        }
    }
    var popupStatus2 = 0;
    function loadPopup2() {
        if (popupStatus2 == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup2").fadeIn(0500); // fadein popup div
            $("#backgroundPopup2").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup2").fadeIn(0001);
            popupStatus2 = 1; // and set value to 1
        }
    }
    function disablePopup2() {
        if (popupStatus2 == 1) { // if value is 1, close popup
            $("#toPopup2").fadeOut("normal");
            $("#backgroundPopup2").fadeOut("normal");
            popupStatus2 = 0; // and set value to 0
        }
    }
    var popupStatus3 = 0;
    function loadPopup3() {
        if (popupStatus3 == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup3").fadeIn(0500); // fadein popup div
            $("#backgroundPopup2").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup2").fadeIn(0001);
            popupStatus3 = 1; // and set value to 1
        }
    }
    function disablePopup3() {
        if (popupStatus3 == 1) { // if value is 1, close popup
            $("#toPopup3").fadeOut("normal");
            $("#backgroundPopup2").fadeOut("normal");
            popupStatus3 = 0; // and set value to 0
        }
    }
    var popupStatus4 = 0;
    function loadPopup4() {
        if (popupStatus4 == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup4").fadeIn(0500); // fadein popup div
            $("#backgroundPopup4").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup4").fadeIn(0001);
            popupStatus4 = 1; // and set value to 1
        }
    }
    function disablePopup4() {
        if (popupStatus4 == 1) { // if value is 1, close popup
            $("#toPopup4").fadeOut("normal");
            $("#backgroundPopup4").fadeOut("normal");
            popupStatus4 = 0; // and set value to 0
        }
    }
    var popupStatus9 = 0;
    function loadPopup9() {
        if (popupStatus9 == 0) { // if value is 0, show popup
            closeloading(); // fadeout loading
            $("#toPopup9").fadeIn(0500); // fadein popup div
            $("#backgroundPopup9").css("opacity", "0.7"); // css opacity, supports IE7, IE8
            $("#backgroundPopup9").fadeIn(0001);
            popupStatus9 = 1; // and set value to 1
        }
    }
    function disablePopup9() {
        if (popupStatus9 == 1) { // if value is 1, close popup
            $("#toPopup9").fadeOut("normal");
            $("#backgroundPopup9").fadeOut("normal");
            popupStatus9 = 0; // and set value to 0
        }
    }
    /************** end: functions. **************/
}); // jQuery End