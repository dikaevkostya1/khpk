$(function(){
    SupportsCSS = function (property, value) {
        let element = document.createElement('span');
        if (element.style[property] !== undefined)
            element.style.cssText = property + ':' + value;
        else
            return false;
        return element.style[property] === value;
    };
});