INSTALLATION GUIDE

-Orange template.
-PullDownMenu.

created by Jeroen Bosch - bosch.jeroen[at]gmail.com - http://bosch.ondergrond.net/
created on 30-07-2005 for Etomite 0.6 - http://www.etomite.org/
special thanks goes to Ralph A. Dahlgren - rad14701@yahoo.com and the people at
http://www.sitepoint.com/ and http://www.alistapart.com/

DISCLAIMER: Use at your onw risk. Don't look at me if the code or you do something stupid!

CONTENTS OF THE PACKAGE:

1. template_orange.html
2. menu.css
3. style.css
4. tabs.css
5. menu.inc.js
6. MemberLogin.php
7. Memberlogout.php
8. PullDownMenu.php
9. tabs_background.gif
10. readme.txt (the file your're looking at)

PURPOSE

This package will spice up your Etomite installation with one hell of a template and a few powerfull snippets. The template and it's accompanying menu offer a good basis for a well managed and organised website. While the template has cool feates like a footer that sits on the bottom of your screen, even when there is no content to fill the whole viewport, the menu offers exclusive menu's for loged-in users only. Etomite is not designed as a portal, so it wont help you with that, but you can give certain users a special or personal back-end to update very specific parts of a website.

This complete template suite will also be a nice basis for further development. I'd would appreciate it if you let me know if you are using this template and/or it's snippets in a altered state. Not to police you, but out of curiosity.

FUNCTIONALITY

the template:

- Footer sits on bottom of viewport even when there is not enough content to fill it up.
- The main content is one of the first things in the template. Next are the left collum, right collum and footer. The header is actually the last thing that gets loaded. This is good for seach engines which get the real information right away. That way your page has a better change for a good screening.
- Nice Looking tabs
- Template Is Valid XHTML 1.0 Transitional!
- Template and menu use Valid CSS!
- Tested for IE5/win, IE6/win, IE5/mac, IE6/mac, Opera (7), Firefox (duh!)

the menu:

- Valid CSS
- Lots of comments in the snippet code
- add's a login to your site
- choose where you want your login and logout buttons
- Looks cool and has a good feel
- Tested for IE5/win, IE6/win, IE5/mac, IE6/mac, Opera (7), Firefox (duh!)



HOW TO INSTALL

1. Unpack the .zip to your harddisk.
2. Think about the following:
	a) a bunch of names of current and future individual menu's on your site.
	b) your girlfriend. If you don't have one, stop being a nerd and go get one!
3. Open the file 'menu.inc.js' in your favorite editor and add the names of the menu's in the String on line 27. (see comments in the file). Save the file for later use.
4. Use your favorite ftp program to do the following:
	a) create a dir called 'orange' in assets/site/ (all file paths are relative to your Etomite root)
	b) copy 'menu.inc.js', 'menu.css', 'tabs.css' and 'style.css' to assets/site/orange/
	c) copy 'tabs_background.gif' to assets/images/
5. Go to the Etomite Manager and do the following:
	a) copy and paste the content of 'template_orange.html' into a new template called 'Orange'
	b) copy and paste the content of 'MemberLogin.php' into a new snippet called 'MemberLogin' (Case sensitive!)
	c) copy and paste the content of 'MemberLogout.php' into a new snippet called 'MemberLogout'
	d) copy and paste the content of 'PullDownMenu.php' into a new snippet called 'PullDownMenu'
6. Now do some magic in the Etomite Manager.
	a) create a new document in an unpublished folder (like: 'Repository') called Login. Remember the ID of this document. Place a snippet call to [[MemberLogin]] in the document.
	b) create a new document in an unpublished folder called Logout. Remember the ID of this document. Place a snippet call to [[MemberLogout]] in the document.
	c) Go back to 'PullDownMenu' snippet and walk through the config settings there. Enter or change the ID's of the login and logout page to ID's you remembered. Save the changes.
7. Almost there. Go back to edit the new Orange template. On line 28, 29 and 30 you see a three snippet calls. Delete the last two and add some of your own. Remember that individual menu's must be placed in a unplublished folder (otherwise they will be displayed by the default snippet call:[[PullDownMenu?id=0&title=Navigation&auth=0]]). The ID must be that of the unpublished folder which holds the folders or documents of the submenu. The title you specify should match one in the string in 'menu.inc.js' (see 3, else it won't work in IE) This is also the title displayed just above the menu.

Here is how Ralph discribed the optionsn for his MemberMakeMenu which works the same:

# Usage: [[MemberMakeMenu?id=123&&title=Member Menu&auth=1&allow=me,you&deny=them]]
#        This example shows every passable variable assignment possible to the snippet, as written.
#        This call tells the snippet that it should use the children of the folder document (?id=123)
#        in the menu, display the menu title as ?Member Menu?, require authorization for this menu
#        (&auth=1), and to allow the members ?me? and ?you? (&allow=me,you), and deny the member ?them?
#        (&deny=them). It is highly unlikely, however, that both the $allow and $deny arrays would be
#        required for the same menu.
#
#        If you want to allow every member access to a given menu you would issue the snippet call
#        [[MemberMakeMenu?id=123&title=Member Menu&auth=1]]
#
#        To display a menu without checking authorization you would issue the snippet call
#        [[MemberMakeMenu?id=123&title=Member Menu]]


View my website for recent updates.

If you find this guide usefull or have some tips, hints or suggestions for improvement, please contact me on bosch.jeroen[at]gmail.com or visit http://bosch.ondergrond.net/

Live long and prosper!
