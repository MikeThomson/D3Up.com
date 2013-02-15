D3Up.com
---

If you're wanting to setup a local instance of D3Up, here's a few things you'll need to do:

- Copy `application/config/application.template` to `application/config/application.php` and change the key value for MCrypt Encryption.  
- Make sure to run `git submodule update --init` to pull in a copy of Epic_Mongo and Laravel (both submodules of the project).
