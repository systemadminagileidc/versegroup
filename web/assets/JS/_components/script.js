function O(i) {
    return typeof i == 'object' ? i : document.getElementById(i)
}

function S(i) {
    return O(i).style

}

function C(i) {
    return document.getElementByClassName(i)
}
'use strict';
(function ($) {
        // $('p').each(function(){
        //     var string = $.trim($(this).html());
        //     string = string.replace(/ ([^ ]*) ([^ ]*)$/,'&nbsp;$1&nbsp;$2');
        //     $(this).html(string);
        // });


        // Chaning contents of video links to use the video sources thumbnail image if available, from old site
        $(".videolink").each(function() {
            var $a = $(this);
            var oldval = $a.text();
            var url = $a.attr('href');
            if(url.match(/youtube.com/)){
                var code = url.match(/v[=\/]([^\n&?]+)/)[1];
                $a.attr('rel','youtube');
                //.attr('href','http://www.youtube.com/embed/'+code)
                $a.html('<img src="https://img.youtube.com/vi/'+code+'/0.jpg" alt="'+oldval+'" />');
            } else if(url.match(/youtu.be/)){
                var code = url.match(/youtu.be\/([^\n&?]+)/)[1];
                $a.attr('rel','youtube').attr('href','https://www.youtube.com/watch?v='+code);
                //.attr('href','http://www.youtube.com/embed/'+code)
                $a.html('<img src="https://img.youtube.com/vi/'+code+'/0.jpg" alt="'+oldval+'" />');
            } else if(url.match(/dailymotion.com/)){
                var code = url.match(/dailymotion.com\/([^\n&?_]+)\/?/)[1];
                $a.attr('rel','dailymotion');
                //.attr('href','http://www.dailymotion.com/embed/video/'+code)
                $a.html('<img src="http://www.dailymotion.com/thumbnail/video/'+code+'/0.jpg" alt="'+oldval+'" />');
            } else if(url.match(/vimeo.com/)) {
                var code = url.match(/vimeo.com\/([^\n&?_]+)\/?/)[1];
                $a.html('')
                $a.attr('rel','vimeo');
                //$a.attr('href','http://player.vimeo.com/video/'+code);
                $.ajax({
                    type:'GET',
                    url: 'https://vimeo.com/api/v2/video/' + code + '.json',
                    dataType: 'json',
                    success: function(data){
                        var thumbnail_src = data[0].thumbnail_large;
                        $a.html('<img src="' + thumbnail_src + '" alt="'+oldval+'"/>');
                    }
                });
            }
        });


})(jQuery); // Fully reference jQuery after this point

// Made this global for reuse
// Utility function to prevent calls being called to often
function throttle(fn, threshhold, scope) {
  threshhold || (threshhold = 250);
  var last,
      deferTimer;
  return function () {
    var context = scope || this;

    var now = +new Date,
        args = arguments;
    if (last && now < last + threshhold) {
      // hold on to it
      clearTimeout(deferTimer);
      deferTimer = setTimeout(function () {
        last = now;
        fn.apply(context, args);
      }, threshhold);
    } else {
      last = now;
      fn.apply(context, args);
    }
  };
}