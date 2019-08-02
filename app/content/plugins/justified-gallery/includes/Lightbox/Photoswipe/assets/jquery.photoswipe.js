(function( $ ) {
    $.fn.photoswipe = function(options){
        var galleries = [],
            _options = options;
        
        var init = function($this){
            galleries = [];
            $this.each(function(i, gallery){
                galleries.push({
                    id: i,
                    items: []
                });

                $(gallery).find('a').each(function(k, link) {
                    var $link = $(link),
                        $figure = $link.parent('figure'),
                        size = $figure.data('size').split('x');
                    if (size.length != 2){
                        throw SyntaxError("Missing data-size attribute.");
                    }
                    $figure.data('gallery-id',i+1);
                    $figure.data('photo-id', k);

                    var item = {
                        src: link.href,
                        msrc: link.children[0].getAttribute('src'),
                        w: parseInt(size[0],10),
                        h: parseInt(size[1],10),
                        title: $figure.data('sub-html'),
                        el: link
                    }

                    galleries[i].items.push(item);
                    
                });

                $(gallery).on('click', 'a', function(e){
                    e.preventDefault();
                    var $figure = $(this).parent('figure'),
                        gid = $figure.data('gallery-id'),
                        pid = $figure.data('photo-id');
                    openGallery(gid,pid);
                });
            });
        }
        
        var parseHash = function() {
            var hash = window.location.hash.substring(1),
            params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');  
                if(pair.length < 2) {
                    continue;
                }           
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            if(!params.hasOwnProperty('pid')) {
                return params;
            }
            params.pid = parseInt(params.pid, 10);
            return params;
        };
        
        var openGallery = function(gid,pid){
            var pswpElement = document.querySelectorAll('.pswp')[0],
                items = galleries[gid-1].items,
                options = {
                    index: pid,
                    galleryUID: gid,
                    getThumbBoundsFn: function(index) {
                        var thumbnail = items[index].el.children[0],
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect(); 

                        return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                    }
                };
            $.extend(options,_options);
            var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        }
        
        // initialize
        init(this);
        
        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = parseHash();
        if(hashData.pid > 0 && hashData.gid > 0) {
            openGallery(hashData.gid,hashData.pid);
        }
        
        return this;
    };
}( jQuery ));