"use strict";
angular.module('bandcampApp.config', [])
.constant('ENV', 'production')

.constant('baseUrl', 'https://api.crossover.com/api')

.constant('clientUrl', 'https://www.crossover.com/x')

.constant('storageBaseUrl', 'https://s3.amazonaws.com/')

.constant('externalUrl', undefined)

.constant('routePrefix', 'views/')

.constant('uploadedDocsUrl', 'https://crossover-uploads-production.s3.amazonaws.com')

.constant('linkedInApiKey', '787fo93vvlysh1')

.constant('intercomKey', 'w4ev5r2t')

.constant('intercomContractorAppId', 'th0oxd5l')

.constant('intercomVisitorAppId', 'th0oxd5l')

.constant('skypeIdRegex', '^([A-Za-z]([A-Za-z0-9\\._\\-\\+@:]){5,99})$')

.constant('googleCalendarIntegrationSettings', {PLATFORM_JS:'https://apis.google.com/js/platform.js',CLIENT_JS:'https://apis.google.com/js/client.js',CLIENT_ID:'199971004081-bnftmhshsqdifpgl3qcsnhjnb8sovddk.apps.googleusercontent.com',SCOPES:['https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/calendar.readonly'],IMMEDIATE:false,DOMAIN:'crossover.com',AUTH_USER:-1,ACCESS_TYPE:'offline',RESPONSE_TYPE:'code token',APPROVAL_PROMPT:'force'})

.constant('techScreenUrl', 'http://techscreen.crossover.com/')
;