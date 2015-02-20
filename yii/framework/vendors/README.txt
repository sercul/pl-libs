/htmlpurifier was updated from 4.2.0 to 4.6.0 according to the issue #422:

On current version of HtmlPurifier library 4.2.0 I faced with a bug:
"Fatal error: Maximum function nesting level of '100' reached, aborting!"
It fires on some email messages while grabbing it.
The solution is to update to v.4.6.0 which is fixed and included in Yii 1.1.16