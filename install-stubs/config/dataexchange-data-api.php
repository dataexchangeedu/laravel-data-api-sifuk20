<?php
return [
    // Enter the Base URL given in your deployment's credentials here, followed by '/rest/sif/requests'
    // For example if the base URL is https://broker.dataexchange.education then enter https://broker.dataexchange.education/rest/sif/requests
    // If left null then the default is used (https://uk.staging.dataexchange.education/rest/sif/requests)
    'url' => null,

    // Enter the token given in your deployment's credentials here
    // It is strongly advised that you store this token in your environment file and access it using the env() helper.
    // This is to avoid putting your secure token into version control - it is your responsibility to keep this token safe!
    'token' => ''
];
