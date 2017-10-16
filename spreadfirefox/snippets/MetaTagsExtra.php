//<?php

/**
| --------------------------------------------------------------------------
| Snippet Title:     MetaTagsExtra
| Snippet Version:   1.5 (final)
| Etomite Version:   0.6 +
|
| Description:
|   Returns HTML for document dependant meta tags: Generator,
|   Description, Keywords, Abstract, Author, Copyright,
|   Robots, Googlebot, Cache-Control, Pragma, Expires and Last Modified
|
| Snippet Author:
|   Miels with mods by Lloyd Borrett (lloyd@borrett.id.au)
|
| Version History:
|   1.3 - Lloyd Borrett added the Robots meta tag based
|   on the idea in the SearchableSE snippet by jaredc
|
|   1.4 - Lloyd Borrett added the Abstract meta tag
|   based on the Site Name and the Long Title.
|   Also added the Generator meta tag based on the Etomite version details.
|   The Robots meta tag is now only output if the document is non-searchable,
|   to reduce HTML bloat. The Googlebot meta tag is now also output
|   when the document is non-searchable.
|
|   1.5 - Lloyd Borrett added no-cache directives via the Cache-Control
|   and Pragma meta tags if the document is non-cacheable.
|   Abstract meta tag uses the document description if long title not set.
|   Cleaned up some other tests.
|
|
| Snippet Category:
|   Search Engines
|
| Usage:
|   Insert [[MetaTags]] anywhere in the head section of your template.
|   Don't forget to set the full name of all document authors.
|   You can find it at "Manage users" -> your username -> "full name".
|   This value is used for the Author and Copyright meta tags.
|
|   When you mark a page as "NOT searchable" - a Robots meta tag
|   with "noindex, nofollow" is inserted to keep web search engines
|   from indexing that document. After all, there's little value in
|   making your Etomite document unsearchable to Etomite, when
|   Google still knows where it is! For "searchable" documents, no
|   Robots meta tag is inserted. The default is "index, follow", so not
|   putting it in reduced HTML bloat.
|   A Googlebot meta tag with "noindex, nofollow, noarchive, nosnippet"
|   is also output, to tell Google to clean out its cache.
|
|   When you mark a page as "non cacheable", no-cache directives
|   are inserted via the Cache-Control and Pragma meta tags.
| ---------------------------------------------------------------------------
*/

$MetaGenerator = "";
$MetaDesc = "";
$MetaKeys = "";
$MetaAbstract = "";
$MetaAuthor = "";
$MetaCopyright = "";
$MetaRobots = "";
$MetaGooglebot = "";
$MetaCache = "";
$MetaPragma = "";
$MetaExpires = "";
$MetaEditedOn = "";

// *** GENERATOR ***
$version = $etomite->getVersionData();
$MetaGenerator = " <meta name=\"generator\" content=\"Etomite";
if (!$version['version'] == "") {
    $MetaGenerator .= " ".$version['version'];
}
if (!$version['code_name'] == "") {
    $MetaGenerator .= " (".$version['code_name'].")";
}
$MetaGenerator .= "\" />\n";

$docInfo = $etomite->getDocument($etomite->documentIdentifier);

// *** DESCRIPTION ***
$description = $docInfo['description'];
if (!$description == "") {
    $MetaDesc = " <meta name=\"description\" content=\"$description\" />\n";
}

// *** KEYWORDS ***
$keywords = $etomite->getKeywords();
if (count($keywords)>0) {
    $keys = join($keywords, ", ");
    $MetaKeys = " <meta name=\"keywords\" content=\"$keys\" />\n";
}

// *** ABSTRACT ***
// Use the Site Name and the documents Long Title (or Description)  
// to build an Abstract meta tag.
$sitename = $etomite->config['site_name'];
$abstract = $docInfo['longtitle'];
if ($abstract == "") {
    $abstract = $description;
}
if (!sitename == "") {
    $MetaAbstract = " <meta name=\"abstract\" content=\"".$sitename;
    if (!$abstract == "") {
        $MetaAbstract .= " - ".$abstract."\" />\n";
    } else {
        $MetaAbstract .= "\" />\n";
    }
} else {
    if (!$abstract == "") {
        $MetaAbstract = " <meta name=\"abstract\" content=\"";
        $MetaAbstract .= $abstract."\" />\n";
    }
}

// *** AUTHOR, COPYRIGHT, PUBLISHER and COMPANY ***
$authorid = $docInfo['createdby'];
$createdon = date(Y, $docInfo['createdon']);
$tbl = $etomite->dbConfig['dbase'].".".$etomite->dbConfig['table_prefix']."user_attributes";
$query = "SELECT fullname FROM $tbl WHERE $tbl.id = $authorid";
$rs = $etomite->dbQuery($query);
$limit = $etomite->recordCount($rs);
if ($limit=1) {
    $resourceauthor = $etomite->fetchRow($rs);
    $authorname = $resourceauthor['fullname'];
}
if (!$authorname == "") {
    $MetaAuthor = " <meta name=\"author\" content=\"$authorname\" />\n";
    $MetaCopyright = " <meta name=\"copyright\" content=\"Copyright (c) $createdon by $authorname. All rights reserved.\" />\n";
}

// *** ROBOTS and GOOGLEBOT ***
// Determine if this document has been set to non-searchable.
// As the default for the Robots and Googlebot Meta Tags are index and follow,
// these tags are only needed when we don't want the document searched. 
if (!$etomite->documentObject['searchable']) {
    $MetaRobots = " <meta name=\"robots\" content=\"noindex, nofollow\" />\n";
    $MetaGooglebot = " <meta name=\"googlebot\" content=\"noindex, nofollow, noarchive, nosnippet\" />\n";
}

// *** CACHE-CONTROL and PRAGMA ***
// Output no-cache directives via the Cache-Control and Pragma meta tags
// if this document is set to non-cacheable. 
$cacheable = $docInfo['cacheable'];
if (!$cacheable) {
    $MetaCache = " <meta http-equiv=\"cache-control\" content=\"no-cache\" />\n";
    $MetaPragma = " <meta http-equiv=\"pragma\" content=\"no-cache\" />\n";
}

// *** EXPIRES ***
$unpubdate = date(r, $docInfo['unpub_date']);
if ($unpubdate > 0) {
    $MetaExpires = " <meta http-equiv=\"expires\" content=\"$unpubdate\" />\n";
}

// *** LAST MODIFIED ***
$editedon = date(r, $docInfo['editedon']);
$MetaEditedOn = " <meta http-equiv=\"last-modified\" content=\"$editedon\" />\n";


// *** RETURN RESULTS ***

$output = $MetaGenerator.$MetaDesc.$MetaKeys.$MetaAbstract.$MetaAuthor.$MetaCopyright;
$output .= $MetaRobots.$MetaGooglebot.$MetaCache.$MetaPragma.$MetaExpires.$MetaEditedOn;

return $output;
