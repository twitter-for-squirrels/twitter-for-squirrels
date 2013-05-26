# locust

locust.io is a python-based load tester. It's rad because the tests are just normal python
code instead of being a pile of gross XML. It was apparently used by the people behind
Battlefield 3, so I guess it probably works. We should probably do some sniff tests with
`ab` to make sure they're comparable.

## install it

1. Install `pip`, the python package manager
      yum install python-setuptools
      easy_install pip
2. Install libevent: `apt-get install libevent-devel`
2. Install python-dev `apt-get install python-dev`
2. Install locust.io `pip install locustio`

## use it

Run `locust -f locust/test.py -H http://33.33.33.10` in our repo, then go to the web server
it spits out. Then you can start a test using the GUI.
