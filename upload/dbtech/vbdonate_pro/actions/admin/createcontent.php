<?php

$thistime = time(); 

print_cp_header($vbphrase['dbtech_vbdonate_cuscon_cpheader']);
print_form_header('vbdonate_banner', 'docreatecontent');
print_table_start();
print_table_header($vbphrase['dbtech_vbdonate_cuscon_create_content']);
print_input_row($vbphrase['dbtech_vbdonate_cuscon_titles'] . '<dfn>' . $vbphrase['dbtech_vbdonate_cuscon_titles_desc'] . '</dfn>', 'title', '', 0, 60);
print_input_row($vbphrase['dbtech_vbdonate_cuscon_image_loc'] . '<dfn>' . $vbphrase['dbtech_vbdonate_cuscon_image_loc_desc'] . '</dfn>', 'previewimage', '', 0, 60);
print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_incms'], 'in_cms');
print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_inforum'], 'in_forum');
print_yes_no_row($vbphrase['dbtech_vbdonate_cuscon_actives'], 'active');
print_submit_row();
 /*print_description_row ('<style type="text/css">
body { background:url("http://localhost/dbtech_vb4_new/dbtech/vbdonate/images/metal.jpg") repeat scroll 0 0 #000000;;color:white; }
a:link, a:visited, a:active { color:white; }
.optiontitle { background:#461B7E;color:#FFF;border:none; }
.button { background:#461B7E;border:none;color:white;padding:6px 12px;}
.button:hover { background:#057c08; }
.tcat { color:white;background: transparent;border:none; }
.tcat a:link, .tcat a:visited, .tcat a:active { color:white; }
.tfoot { background:transparent;border-top:3px solid #461B7E; }
.alt1 { color:white;background:transparent; }
.alt2 { color:white;background:transparent; }
td.thead { color:white;background: #000;border:none; }
select.bginput { color:white;background: #461B7E;border:none; }
legend { color:white;background: transparent;border#461B7E; }
.tborder { border:3px solid #461B7E; -moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;-moz-box-shadow: 2px 2px 8px #000;-webkit-box-shadow: 2px 2px 8px #000;box-shadow: 2px 2px 8px #000; }
textarea, .bginput, input.col-c, input.col-i, input.col-g { border:3px solid #461B7E;color:#EEE;background:transparent; }
.pagetitle { background:#461B7E;color:white;border:1px solid #000;-moz-box-shadow: 2px 2px 8px #000;-webkit-box-shadow: 2px 2px 8px #000;box-shadow: 2px 2px 8px #000; }
</style>');*/
print_cp_footer();
?>