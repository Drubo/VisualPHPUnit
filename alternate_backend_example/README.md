# Alternate Post Handler Example

This directory contains an example of an alternate post handler
for running phpunit tests.  The example included is a controller
for the CodeIgniter framework.  In the bootstrap configuration
file, you can set the alternate_post_handler to a url that is
directed to the controller in your CodeIgniter instance.

The controller creates a global reference to the CodeIgniter
instance so that your unit tests can use CodeIgniter functions.

In the controller, you have to set the paths in the _load_settings
function for it to work properly.

Normally, I would recommend using my-ciunit at 
https://bitbucket.org/kenjis/my-ciunit, but if you cannot use it
(for example if you are testing hmvc modules), this is a decent
approach, I think.
