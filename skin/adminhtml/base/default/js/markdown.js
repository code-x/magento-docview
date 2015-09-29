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

});

