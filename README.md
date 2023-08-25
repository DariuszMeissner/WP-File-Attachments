# WP-File-Attachments

Wordpress plugin adding file attachments as custom fields.

## Requirements plugins

ACF Pro

## Installation

1.Put directory 'wp-file-attachments' in your wordpress plugins directory and active.
2.Install the ACF PRO plugin
3.Set custom fields in ACF PRO like below

### Settings custom fields

Main field:
Field type: repeater
Field name: repeater_attachment

Subfield:
Field type: file
Fields name: file
Return value: Filed ID

### Insert in to template

Use shortcode [acf_repeater_attachment_shortcode]
