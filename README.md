fix-zeus
========

* Thank for [fzaninotto/Faker](https://github.com/fzaninotto/Faker);
* fix-zeus use Faker to create random data
* Just want to fix zeus data, what is the reason? I don't want to too relay on zeus!

###Usage:

####Install with Composer
```
"require": {
    "eleme/fix-zeus": "~0.1"
}
```

####Use fix-zeus to fix date
* Config your namespace and thrift service in src/model/Service.php
```
    public static $nSpace = array(
        "namespace" => "thrift service name" . "_",
        "gfix" => "GfixService_" //example
    );
```
```
use Fixzeus\Factory;
Factory::fix($service, $method, $path);
```
* $service: the namespace you define in your thrift file
* $method: the method you define in your thrift service
* $path: your define value json file

####Customize or range a value
To define a value you want, you just write a json file like below,
and give the file's absolute path to the entrace function: Factory::fix($service, $method, $path)
* define_value: customize value for a variable
* range_value: give the range to a variable (now just support these types: integer/date/time/datetime/unixtime/user_agent)
```
{
    "define_value": {
        "name": "cjp",
        "age": "22"
    },
    "range_value": {
        "integer": {
            "type": "integer",
            "min": "1",
            "max": "10"
        },
        "date": {
            "type": "date",
            "format": "Y-m-d",
            "max": "2014-11-11"
        },
        "time": {
            "type": "time",
            "format": "H:i:s",
            "max": "22:22:22"
        },
        "datetime": {
            "type": "datetime",
            "format": "Y-m-d H:i:s",
            "min": "2013-11-11 22:22:22",
            "max": "2014-11-11 22:22:22"
        },
        "unixtime": {
            "type": "unixtime",
            "max": "now"
        },
        "user_agent": {
            "type": "userAgent",
            "value": "chrome/firefox/safari/opera/internetExplorer"
        }
    }
}
```
