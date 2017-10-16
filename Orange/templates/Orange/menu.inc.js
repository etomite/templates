// Javascript document

// This is part of the script that makes the PullDownMenu work in MSIE
// By: Jeroen Bosch, Jan 2005. Thanxs to www.sitepoint.com
// bosch.jeroen[at]gmail.com

function startList(navId) {
  if (document.all&&document.getElementById) {
   var navRoot = document.getElementById(navId);
    for (i=0; i<navRoot.childNodes.length; i++) {
     node = navRoot.childNodes[i];
      if (node.nodeName=="LI") {
       node.onmouseover=function() {
        this.className+=" over";
         }
          node.onmouseout=function() {
           this.className=this.className.replace(" over", "");
            }
         }
     }
   }
}

// second part of the script that makes the menu work in MSIE

function initAll() {
 var menus=String("Navigation Beheer Projects Etomite").split(' '); // add the menu titles here.
 for (var i=0; i<menus.length; i++) {
  var id=menus[i];
  if (document.getElementById(id)) {
   startList(id);
  }
 }
}
window.onload=initAll;

// END of code