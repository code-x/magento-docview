document.observe("dom:loaded", function() {
    var headings = $$('.markdown h2,.markdown h3');

    $$('.markdown').first().insert({
        bottom: new Element('div', {id: 'aside-wrapper'})
    });

    headings.forEach(function(element){

        var a_title = element.innerHTML;
        var new_link = document.createElement('a');
        var linkText = document.createTextNode(a_title);
        new_link.setAttribute('href', '#' + a_title.toLowerCase().replace(' ', '_'));
        new_link.setAttribute('class', element.nodeName.toLowerCase());
        new_link.setAttribute('title', a_title);
        new_link.appendChild(linkText);

        element.setAttribute('id',a_title.toLowerCase().replace(' ', '_'))

        $('aside-wrapper').appendChild(new_link);
    });

    document.observe('scroll', function(event) {
        var scrollTop = document.viewport.getScrollOffsets().top; // aktuelle Scroll Position
        var headerHeight = $$('.middle').first().offsetTop; // Hoehe des Headers
        var positionTop = headerHeight - scrollTop + 20;

        if (positionTop > 20) {
            $('aside-wrapper').style.top = positionTop+'px';
        } else {
            $('aside-wrapper').style.top = '20px';
        }
    });

});

