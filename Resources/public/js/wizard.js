$(document).ready(function() {
    $('#tutorialwizard').bootstrapWizard(
        {
            'nextSelector': '.next, .tutorial_link',
            'previousSelector': '.previous',
            onTabShow: function(tab, navigation, index) {

                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#tutorialwizard').find('.bar').css({width:$percent+'%'});

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#tutorialwizard').find('.pager .next').hide();
                    $('#tutorialwizard').find('.pager .finish').show();
                    $('#tutorialwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#tutorialwizard').find('.pager .next').show();
                    $('#tutorialwizard').find('.pager .finish').hide();
                }

                $('#tutorialwizard .finish').click(function() {
                    console.log($('#tutorialwizard .finish > a').attr('href'));
                    window.location = $('#tutorialwizard .finish > a' ).attr('href');
                });
            }}
    );

    $('.tutorial_link_prevent').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
        console.log('click');
    });

    $('.tutorial_link_prevent').on('dblclick', function(event){
        event.preventDefault();
        event.stopPropagation();
        console.log('here');
        $('#tutorialwizard').bootstrapWizard('next');
    });

//
//    $('.tutorial_link').pulsate({
//        color: "hsl(360, 76%, 25%)", // set the color of the pulse
//        reach: 5,                              // how far the pulse goes in px
//        speed: 1000,                            // how long one pulse takes in ms
//        pause: 2,                               // how long the pause between pulses is in ms
//        glow: true,                             // if the glow should be shown too
//        repeat: true,                           // will repeat forever if true, if given a number will repeat for that many times
//        onHover: false                          // if true only pulsate if user hovers over the element
//    });
});
