/**
 * NUS User Interface
 */ 
var NUS = {
    //handle to accordion
    homeacc: null,
    
    /**
     * Init UI functions
     */         
    init: function () {
        NUS.SortableBoxes.init();
        NUS.textSize();
        // NUS.emulateHover($('#nav li'));
        // NUS.mainNav();
        NUS.sitePrefsToggle($('.prefs a'));
        NUS.homeAccordion();
        NUS.audiencePanels();
        NUS.expandableBoxes();
        NUS.rollovers();
        NUS.preloadImages(["images/buttons/index-submit_over.gif", 
                           "images/buttons/full-page_over.gif", 
                           "images/bg/flyout.jpg", 
                           "images/bg/audience-panel.jpg"]);
        /*NUS.azIndex('#az-index-search', '#az-index-results', '#az-desc');
        $(".az-index form").bind("submit", function() { return false; });
        NUS.wipSlideshow('#slideshow', '{timeout: 5000}');*/
        NUS.loadPrefs();

    },
    
    
    /**
     * Increase/decrease text size
     */          
    textSize: function () {
        
        if ($.cookie('larger-text')) {
            $('body').addClass('large-text');
        }
        
        $('.accessibility .increase').bind('click', function () {
            $('body').addClass('larger-text');
            $.cookie('larger-text', 1);
            return false;
        });
        
        $('.accessibility .decrease').bind('click', function () {
            $('body').removeClass('larger-text');
            $.cookie('larger-text', null);
            return false;
        });
    },
    
    /**
     * Home page accordion
     */ 
    homeAccordion: function () {
        homeacc = $('#home-accordion').accordion({ 
            header: 'h2',
            selectedClass: 'current'
        }).bind("click", function(event) {
            $('#home-accordion .inner').removeClass('opened');
        }).bind("accordionchange", function(event, ui) {
            ui.newContent.addClass('opened');
        });
    },          
    
    /**
     * Toogle expandle boxes on home page
     */         
    expandableBoxes: function () {
        $('.expandable-box .tab a').bind('click', function () {
             $(this).parents('.expandable-box').find('.inner').toggleClass('expanded-box');
             $(this).toggleClass('expanded');
             return false;
        });
    },
    
    /**
     * Toogle alumni panels
     */         
    audiencePanels: function () {
        var panels = $('.audience-panel:not(.audience-panel-static)');
        /*var links = $('#audience-nav a:not(#a-nav06)');*/
        var links = $('#audience-nav:not(.audience-nav-static) a');
        links.each(function (i) {
            $(this).bind('click', function () {
                panels.each(function (j) {
                    if (i !== j) {
                        $(panels[j]).hide();
                        $(links[j]).removeClass('current');
                    }
                })
                $(panels[i]).slideToggle();
                $(this).toggleClass('current');
                return false;
            });
        });
    },
    
    /**
     * Emulate hover in IE6
     */          
    emulateHover: function (items) {
        items.hover(
            function () {
                $(this).addClass('hover');
            },
            function () {
                $(this).removeClass('hover');
            }
        )
    },
    
    /**
     * Site Preferences toggler
     */          
    sitePrefsToggle: function (items) {
        items.toggle(
            function () {
                $(this).parent().addClass('active');
            },
            function () {
                $(this).parent().removeClass('active');
            }
        )
    },
    
    /**
     * Main navigation
     */          
    mainNav: function () {
        $("#nav > li > a").bind('click', function () {
            $("#nav > li > a").not(this).parent().removeClass('hover');
            if($(this).next() && $(this).next().is('.flyout')) {
              $(this).parent().toggleClass('hover');
              return false;
            }
            return true;
        });
    },
    /**
     * Rollovers buttons
     */
    rollovers: function () {
        $('.rollover').hover(
            function () {
                $(this).attr('src', $(this).attr('src').replace(/.gif/, '_over.gif'));
            },
            function () {
                $(this).attr('src', $(this).attr('src').replace(/_over.gif/, '.gif')); 
            }
        );
    },
     
    /**
     * Preload images
     * @param {Array} images array with names of images   
     */               
    preloadImages: function (images) {
        for (var i = 0; i < images.length; i++) {
            var image = new Image();
            image.src = images[i];
        }
    },

    /** 
     * A-Z Index Autocomplete
     * @param searchbox - <input> to be bound
     * @param results - id of results target
     * @loading - id of loading image/animation
     * @desc - id of element which describes the content (ARIA)
     */
   /* azIndex: function (searchbox, results, desc) {
        clearAutoComplete();
        setAutoComplete(searchbox, results);
        autoComplete("a", "alpha");
        $(searchbox).focus(function(){ $(this).attr("value",""); });
        $(desc).hide();
    },
    */
    /** 
     * WIP Slideshow
     * @param args - options for slideshow (str)
     */
    /*wipSlideshow: function (target, args) {
        $(target).slideshow({timeout: 5000});
    },
*/
    loadPrefs: function() {
        //nav mouseover or hover
        if($.cookie('prefs_navclick') !== null && $.cookie('prefs_navclick') == "1") {
          NUS.mainNav();
        }
        else {
          NUS.emulateHover($('#nav li'));
        }
    
        //accordion
        if ($.cookie('prefs_accordion') !== null && $.cookie('prefs_accordion') != '') {
          homeacc.activate(parseInt($.cookie('prefs_accordion')));
          //$('#home-accordion:nth-child('+parseInt($.cookie('prefs_accordion'))+')').addClass('current');
        }
        
        //search
        if ($.cookie('prefs_search') !== null && $.cookie('prefs_search') != '') {
          $(".search_type:eq(" + $.cookie('prefs_search') + ")").attr("checked","checked");
          $(".search_type2:eq(" + $.cookie('prefs_search') + ")").attr("checked","checked");
        }
        else {
          $(".search_type:eq(0)").attr("checked","checked");
          $(".search_type2:eq(0)").attr("checked","checked");
        }
    }
}


/**
 * Sortable boxes 
 */
NUS.SortableBoxes = {
    
    closed: Array, 
    numSortables: 3,
    /**
     * Init function
     */          
    init: function () {
        NUS.SortableBoxes.moveBoxes();
        NUS.SortableBoxes.toggleBoxes();
        NUS.SortableBoxes.toggleBoxesOnLoad();
    },
        
    /**
     * Move sortable boxes
     */         
    moveBoxes: function () {
        $("#sortable1").sortable({
            connectWith: ["#sortable2", "#sortable3"],
            handle: "h2",
			update: function(e, ui) {
               NUS.SortableBoxes.createCookie('sortable1', $(this).sortable('toArray'));
            },
            receive: function(e, ui) {
                NUS.SortableBoxes.createCookie('sortable1', $(this).sortable('toArray'));
            },
            remove: function(e, ui) { 
                NUS.SortableBoxes.createCookie('sortable1', $(this).sortable('toArray'));
            } 
        }); 
        $("#sortable2").sortable({
            connectWith: ["#sortable1", "#sortable3"],
            handle: "h2",
			 update: function(e, ui) { 
               NUS.SortableBoxes.createCookie('sortable2', $(this).sortable('toArray')); 
            },
            receive: function(e, ui) { 
                NUS.SortableBoxes.createCookie('sortable2', $(this).sortable('toArray')); 
            },
            remove: function(e, ui) { 
                NUS.SortableBoxes.createCookie('sortable2', $(this).sortable('toArray'));
            } 
        });
        $("#sortable3").sortable({
            connectWith: ["#sortable1", "#sortable2"],
            handle: "h2",
			 update: function(e, ui) { 
               NUS.SortableBoxes.createCookie('sortable3', $(this).sortable('toArray')); 
            },
            receive: function(e, ui) { 
                NUS.SortableBoxes.createCookie('sortable3', $(this).sortable('toArray')); 
            },
            remove: function(e, ui) { 
                NUS.SortableBoxes.createCookie('sortable3', $(this).sortable('toArray'));
            } 
        });
    },
    
    createCookie: function (column, boxes) {
       //alert(column);
        var cookie = '';
        for (var i = 0; i < boxes.length; i++) {
            cookie += boxes[i] + ".";
        }
       // alert(cookie);
        $.cookie(column, cookie, {expires: 365});
    },
        
    /**
     * Toggle boxes on/off
     */         
    toggleBoxes: function () {
        var links = $(".customize-box h2 a, .sortable-box h2 a")
        links.bind('click', function () {
             var closedboxes = '';
             $(this).parents('li').toggleClass('sortable-box-closed');
             $('.sortable-box-closed').each(function (i) {
                 closedboxes += $(this).attr('id') + '.';
             });
             $.cookie('closedboxes', closedboxes, {expires: 365});
             return false;
        });
    },
    
    /**
     * Close boxes onload 
     */         
    toggleBoxesOnLoad: function () {
        
        // Check if user set any boxes to be closed
        if ($.cookie('closedboxes') !== null && $.cookie('closedboxes') != '') {
            var closedboxes = $.cookie('closedboxes').slice(0, -1);
            NUS.SortableBoxes.closed = closedboxes.split('.');
       
        // Cookie is set but is empty - user have all boxes opened    
        } else if ($.cookie('closedboxes') !== null && $.cookie('closedboxes') == '') {
            NUS.SortableBoxes.closed = [];
        }
        
        if (NUS.SortableBoxes.closed.length > 0) {
            for (var i = 0; i < NUS.SortableBoxes.closed.length; i++) {
                $("#" + NUS.SortableBoxes.closed[i]).addClass('sortable-box-closed');
            }
        }
    }
}    

$(document).ready(function () {
    NUS.init();
});
