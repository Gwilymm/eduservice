---
title: Eduservice API v1.0.0
language_tabs:
  - javascript: JavaScript
  - php: PHP
language_clients:
  - javascript: ""
  - php: ""
toc_footers: []
includes: []
search: true
highlight_theme: darkula
headingLevel: 2

---

<!-- Generator: Widdershins v4.0.1 -->

<h1 id="eduservice-api">Eduservice API v1.0.0</h1>

> Scroll down for code samples, example requests and responses. Select a language for code samples from the tabs above or the mobile navigation menu.

API for Eduservice Ambassador Management

Base URLs:

* <a href="/">/</a>

# Authentication

- HTTP Authentication, scheme: bearer 

<h1 id="eduservice-api-challenge">Challenge</h1>

## api_challenges_get_collection

<a id="opIdapi_challenges_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/challenges',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/challenges', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/challenges`

*Retrieves the collection of Challenge resources.*

Retrieves the collection of Challenge resources.

<h3 id="api_challenges_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "academicYear": "string",
      "missions": [
        "https://example.com/"
      ],
      "rankings": [
        "https://example.com/"
      ],
      "missionEnd": "2019-08-24T14:15:22Z",
      "sponsorshipEnd": "2019-08-24T14:15:22Z"
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_challenges_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Challenge collection|Inline|

<h3 id="api_challenges_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[Challenge.jsonld](#schemachallenge.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» academicYear|string|false|none|none|
|»» missions|[string]|false|none|none|
|»» rankings|[string]|false|none|none|
|»» missionEnd|string(date-time)|false|none|none|
|»» sponsorshipEnd|string(date-time)|false|none|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<aside class="success">
This operation does not require authentication
</aside>

## api_challenges_post

<a id="opIdapi_challenges_post"></a>

> Code samples

```javascript
const inputBody = '{
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/challenges',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/challenges', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/challenges`

*Creates a Challenge resource.*

Creates a Challenge resource.

> Body parameter

```json
{
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_challenges_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[Challenge.jsonld](#schemachallenge.jsonld)|true|The new Challenge resource|

> Example responses

> 201 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_challenges_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Challenge resource created|[Challenge.jsonschema](#schemachallenge.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

## api_challenges_id_get

<a id="opIdapi_challenges_id_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/challenges/{id}',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/challenges/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/challenges/{id}`

*Retrieves a Challenge resource.*

Retrieves a Challenge resource.

<h3 id="api_challenges_id_get-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Challenge identifier|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_challenges_id_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Challenge resource|[Challenge.jsonschema](#schemachallenge.jsonschema)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_challenges_id_delete

<a id="opIdapi_challenges_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/challenges/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/challenges/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/challenges/{id}`

*Removes the Challenge resource.*

Removes the Challenge resource.

<h3 id="api_challenges_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Challenge identifier|

> Example responses

> 404 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_challenges_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|Challenge resource deleted|None|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_challenges_id_patch

<a id="opIdapi_challenges_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/challenges/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/challenges/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/challenges/{id}`

*Updates the Challenge resource.*

Updates the Challenge resource.

> Body parameter

```json
{
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_challenges_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Challenge identifier|
|body|body|[Challenge](#schemachallenge)|true|The updated Challenge resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_challenges_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Challenge resource updated|[Challenge.jsonschema](#schemachallenge.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-mission">Mission</h1>

## api_missions_get_collection

<a id="opIdapi_missions_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/missions',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/missions', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/missions`

*Retrieves the collection of Mission resources.*

Retrieves the collection of Mission resources.

<h3 id="api_missions_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "name": "string",
      "description": "string",
      "points": 0,
      "challenge": "https://example.com/",
      "admin": "https://example.com/",
      "repeatable": true,
      "requiresProof": true,
      "maxRepetitions": 0,
      "status": "created",
      "missionSubmissions": [
        "https://example.com/"
      ]
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_missions_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Mission collection|Inline|

<h3 id="api_missions_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[Mission.jsonld](#schemamission.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» name|string|false|none|none|
|»» description|string|false|none|none|
|»» points|integer|false|none|none|
|»» challenge|string(iri-reference)|false|none|none|
|»» admin|string(iri-reference)|false|none|none|
|»» repeatable|boolean|false|none|none|
|»» requiresProof|boolean|false|none|none|
|»» maxRepetitions|integer,null|false|none|none|
|»» status|string|false|none|none|
|»» missionSubmissions|[string]|false|none|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|
|status|created|
|status|active|
|status|paused|
|status|completed|

<aside class="success">
This operation does not require authentication
</aside>

## api_missions_post

<a id="opIdapi_missions_post"></a>

> Code samples

```javascript
const inputBody = '{
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/missions',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/missions', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/missions`

*Creates a Mission resource.*

Creates a Mission resource.

> Body parameter

```json
{
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}
```

<h3 id="api_missions_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[Mission.jsonld](#schemamission.jsonld)|true|The new Mission resource|

> Example responses

> 201 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}
```

<h3 id="api_missions_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Mission resource created|[Mission.jsonschema](#schemamission.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

## api_missions_id_get

<a id="opIdapi_missions_id_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/missions/{id}',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/missions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/missions/{id}`

*Retrieves a Mission resource.*

Retrieves a Mission resource.

<h3 id="api_missions_id_get-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Mission identifier|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}
```

<h3 id="api_missions_id_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Mission resource|[Mission.jsonschema](#schemamission.jsonschema)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_missions_id_delete

<a id="opIdapi_missions_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/missions/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/missions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/missions/{id}`

*Removes the Mission resource.*

Removes the Mission resource.

<h3 id="api_missions_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Mission identifier|

> Example responses

> 404 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_missions_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|Mission resource deleted|None|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_missions_id_patch

<a id="opIdapi_missions_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/missions/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/missions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/missions/{id}`

*Updates the Mission resource.*

Updates the Mission resource.

> Body parameter

```json
{
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}
```

<h3 id="api_missions_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Mission identifier|
|body|body|[Mission](#schemamission)|true|The updated Mission resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}
```

<h3 id="api_missions_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Mission resource updated|[Mission.jsonschema](#schemamission.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-missionsubmission">MissionSubmission</h1>

## api_mission_submissions_get_collection

<a id="opIdapi_mission_submissions_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/mission_submissions',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/mission_submissions', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/mission_submissions`

*Retrieves the collection of MissionSubmission resources.*

Retrieves the collection of MissionSubmission resources.

<h3 id="api_mission_submissions_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "ambassador": "https://example.com/",
      "mission": "https://example.com/",
      "proofPath": "string",
      "status": "submitted",
      "rejectionReason": "string",
      "admin": "https://example.com/",
      "submissionDate": "2019-08-24T14:15:22Z",
      "validationDate": "2019-08-24T14:15:22Z"
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_mission_submissions_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|MissionSubmission collection|Inline|

<h3 id="api_mission_submissions_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[MissionSubmission.jsonld](#schemamissionsubmission.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» ambassador|string(iri-reference)|false|none|none|
|»» mission|string,null(iri-reference)|false|none|none|
|»» proofPath|string,null|false|none|none|
|»» status|string|false|none|none|
|»» rejectionReason|string,null|false|none|none|
|»» admin|string,null(iri-reference)|false|none|none|
|»» submissionDate|string(date-time)|false|none|none|
|»» validationDate|string,null(date-time)|false|none|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|
|status|submitted|
|status|approved|
|status|rejected|

<aside class="success">
This operation does not require authentication
</aside>

## api_mission_submissions_post

<a id="opIdapi_mission_submissions_post"></a>

> Code samples

```javascript
const inputBody = '{
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/mission_submissions',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/mission_submissions', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/mission_submissions`

*Creates a MissionSubmission resource.*

Creates a MissionSubmission resource.

> Body parameter

```json
{
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_mission_submissions_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[MissionSubmission.jsonld](#schemamissionsubmission.jsonld)|true|The new MissionSubmission resource|

> Example responses

> 201 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_mission_submissions_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|MissionSubmission resource created|[MissionSubmission.jsonschema](#schemamissionsubmission.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

## api_mission_submissions_id_get

<a id="opIdapi_mission_submissions_id_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/mission_submissions/{id}',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/mission_submissions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/mission_submissions/{id}`

*Retrieves a MissionSubmission resource.*

Retrieves a MissionSubmission resource.

<h3 id="api_mission_submissions_id_get-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|MissionSubmission identifier|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_mission_submissions_id_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|MissionSubmission resource|[MissionSubmission.jsonschema](#schemamissionsubmission.jsonschema)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_mission_submissions_id_delete

<a id="opIdapi_mission_submissions_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/mission_submissions/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/mission_submissions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/mission_submissions/{id}`

*Removes the MissionSubmission resource.*

Removes the MissionSubmission resource.

<h3 id="api_mission_submissions_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|MissionSubmission identifier|

> Example responses

> 404 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_mission_submissions_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|MissionSubmission resource deleted|None|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_mission_submissions_id_patch

<a id="opIdapi_mission_submissions_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/mission_submissions/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/mission_submissions/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/mission_submissions/{id}`

*Updates the MissionSubmission resource.*

Updates the MissionSubmission resource.

> Body parameter

```json
{
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_mission_submissions_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|MissionSubmission identifier|
|body|body|[MissionSubmission](#schemamissionsubmission)|true|The updated MissionSubmission resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}
```

<h3 id="api_mission_submissions_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|MissionSubmission resource updated|[MissionSubmission.jsonschema](#schemamissionsubmission.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-ranking">Ranking</h1>

## api_rankings_get_collection

<a id="opIdapi_rankings_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/rankings',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/rankings', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/rankings`

*Retrieves the collection of Ranking resources.*

Retrieves the collection of Ranking resources.

<h3 id="api_rankings_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "ambassador": "https://example.com/",
      "challenge": "https://example.com/",
      "points": 0
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_rankings_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ranking collection|Inline|

<h3 id="api_rankings_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[Ranking.jsonld](#schemaranking.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» ambassador|string,null(iri-reference)|false|none|none|
|»» challenge|string,null(iri-reference)|false|none|none|
|»» points|integer|false|none|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<aside class="success">
This operation does not require authentication
</aside>

## api_rankings_post

<a id="opIdapi_rankings_post"></a>

> Code samples

```javascript
const inputBody = '{
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/rankings',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/rankings', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/rankings`

*Creates a Ranking resource.*

Creates a Ranking resource.

> Body parameter

```json
{
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}
```

<h3 id="api_rankings_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[Ranking.jsonld](#schemaranking.jsonld)|true|The new Ranking resource|

> Example responses

> 201 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}
```

<h3 id="api_rankings_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Ranking resource created|[Ranking.jsonschema](#schemaranking.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

## api_rankings_id_get

<a id="opIdapi_rankings_id_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/rankings/{id}',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/rankings/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/rankings/{id}`

*Retrieves a Ranking resource.*

Retrieves a Ranking resource.

<h3 id="api_rankings_id_get-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Ranking identifier|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}
```

<h3 id="api_rankings_id_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ranking resource|[Ranking.jsonschema](#schemaranking.jsonschema)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_rankings_id_delete

<a id="opIdapi_rankings_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/rankings/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/rankings/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/rankings/{id}`

*Removes the Ranking resource.*

Removes the Ranking resource.

<h3 id="api_rankings_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Ranking identifier|

> Example responses

> 404 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_rankings_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|Ranking resource deleted|None|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_rankings_id_patch

<a id="opIdapi_rankings_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/rankings/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/rankings/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/rankings/{id}`

*Updates the Ranking resource.*

Updates the Ranking resource.

> Body parameter

```json
{
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}
```

<h3 id="api_rankings_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|Ranking identifier|
|body|body|[Ranking](#schemaranking)|true|The updated Ranking resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}
```

<h3 id="api_rankings_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ranking resource updated|[Ranking.jsonschema](#schemaranking.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-school">School</h1>

## api_schools_get_collection

<a id="opIdapi_schools_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/schools',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/schools', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/schools`

*Retrieves the collection of School resources.*

Retrieves the collection of School resources.

<h3 id="api_schools_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "name": "string",
      "users": [
        "https://example.com/"
      ]
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_schools_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|School collection|Inline|

<h3 id="api_schools_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[School.jsonld](#schemaschool.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» name|string|false|none|none|
|»» users|[string]|false|none|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<aside class="success">
This operation does not require authentication
</aside>

## api_schools_post

<a id="opIdapi_schools_post"></a>

> Code samples

```javascript
const inputBody = '{
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/schools',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/schools', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/schools`

*Creates a School resource.*

Creates a School resource.

> Body parameter

```json
{
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}
```

<h3 id="api_schools_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[School.jsonld](#schemaschool.jsonld)|true|The new School resource|

> Example responses

> 201 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}
```

<h3 id="api_schools_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|School resource created|[School.jsonschema](#schemaschool.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

## api_schools_id_get

<a id="opIdapi_schools_id_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/schools/{id}',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/schools/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/schools/{id}`

*Retrieves a School resource.*

Retrieves a School resource.

<h3 id="api_schools_id_get-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|School identifier|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}
```

<h3 id="api_schools_id_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|School resource|[School.jsonschema](#schemaschool.jsonschema)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_schools_id_delete

<a id="opIdapi_schools_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/schools/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/schools/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/schools/{id}`

*Removes the School resource.*

Removes the School resource.

<h3 id="api_schools_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|School identifier|

> Example responses

> 404 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_schools_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|School resource deleted|None|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_schools_id_patch

<a id="opIdapi_schools_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/schools/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/schools/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/schools/{id}`

*Updates the School resource.*

Updates the School resource.

> Body parameter

```json
{
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}
```

<h3 id="api_schools_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|School identifier|
|body|body|[School](#schemaschool)|true|The updated School resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}
```

<h3 id="api_schools_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|School resource updated|[School.jsonschema](#schemaschool.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-user">User</h1>

## api_me_get

<a id="opIdapi_me_get"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/me',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/me', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/me`

*Récupère l’utilisateur connecté*

Retourne les infos de l’utilisateur du token

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "school": "https://example.com/",
  "schoolName": "string"
}
```

<h3 id="api_me_get-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|User resource|[User.jsonschema-user.read](#schemauser.jsonschema-user.read)|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbidden|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_register_post

<a id="opIdapi_register_post"></a>

> Code samples

```javascript
const inputBody = '{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}';
const headers = {
  'Content-Type':'application/ld+json',
  'Accept':'application/ld+json'
};

fetch('/api/register',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/ld+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/register', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/register`

*Inscription d'un ambassadeur*

Création d'un ambassadeur

> Body parameter

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}
```

<h3 id="api_register_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[User.UserInput.jsonld-user.write](#schemauser.userinput.jsonld-user.write)|true|The new User resource|

> Example responses

> 204 Response

```json
null
```

<h3 id="api_register_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|User resource created|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbidden|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<h3 id="api_register_post-responseschema">Response Schema</h3>

#### Links

<aside class="success">
This operation does not require authentication
</aside>

## api_users_get_collection

<a id="opIdapi_users_get_collection"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/users',
{
  method: 'GET',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('GET','/api/users', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`GET /api/users`

*Retrieves the collection of User resources.*

Retrieves the collection of User resources.

<h3 id="api_users_get_collection-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|page|query|integer|false|The collection page number|

> Example responses

> 200 Response

```json
{
  "member": [
    {
      "@context": "string",
      "@id": "string",
      "@type": "string",
      "id": 0,
      "email": "string",
      "roles": [
        "string"
      ],
      "password": "string",
      "plainPassword": "string",
      "firstName": "string",
      "lastName": "string",
      "phoneNumber": "string",
      "missions": [
        "https://example.com/"
      ],
      "missionSubmissions": [
        "https://example.com/"
      ],
      "rankings": [
        "https://example.com/"
      ],
      "school": "https://example.com/",
      "schoolId": 0,
      "userIdentifier": "string",
      "schoolName": "string",
      "fullName": "string"
    }
  ],
  "totalItems": 0,
  "view": {
    "@id": "string",
    "type": "string",
    "first": "string",
    "last": "string",
    "previous": "string",
    "next": "string"
  },
  "search": {
    "@type": "string",
    "template": "string",
    "variableRepresentation": "string",
    "mapping": [
      {
        "@type": "string",
        "variable": "string",
        "property": "string",
        "required": true
      }
    ]
  }
}
```

<h3 id="api_users_get_collection-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|User collection|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbidden|[Error](#schemaerror)|

<h3 id="api_users_get_collection-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» member|[[User.jsonld](#schemauser.jsonld)]|true|none|none|
|»» @context|any|false|read-only|none|

*oneOf*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|string|false|none|none|

*xor*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»»» *anonymous*|object|false|none|none|
|»»»» @vocab|string|true|none|none|
|»»»» hydra|string|true|none|none|

*continued*

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» @id|string|false|read-only|none|
|»» @type|string|false|read-only|none|
|»» id|integer|false|read-only|none|
|»» email|string|false|none|none|
|»» roles|[string]|false|none|The user roles|
|»» password|string|false|none|The hashed password|
|»» plainPassword|string,null|false|none|Get the plain password (non-persisted field)|
|»» firstName|string|false|none|none|
|»» lastName|string|false|none|none|
|»» phoneNumber|string,null|false|none|none|
|»» missions|[string]|false|none|none|
|»» missionSubmissions|[string]|false|none|none|
|»» rankings|[string]|false|none|none|
|»» school|string(iri-reference)|false|none|none|
|»» schoolId|integer,null|false|none|none|
|»» userIdentifier|string|false|read-only|A visual identifier that represents this user.|
|»» schoolName|string,null|false|read-only|none|
|»» fullName|string|false|read-only|none|
|» totalItems|integer|false|none|none|
|» view|object|false|none|none|
|»» @id|string(iri-reference)|false|none|none|
|»» @type|string|false|none|none|
|»» first|string(iri-reference)|false|none|none|
|»» last|string(iri-reference)|false|none|none|
|»» previous|string(iri-reference)|false|none|none|
|»» next|string(iri-reference)|false|none|none|
|» search|object|false|none|none|
|»» @type|string|false|none|none|
|»» template|string|false|none|none|
|»» variableRepresentation|string|false|none|none|
|»» mapping|[object]|false|none|none|
|»»» @type|string|false|none|none|
|»»» variable|string|false|none|none|
|»»» property|string,null|false|none|none|
|»»» required|boolean|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<aside class="success">
This operation does not require authentication
</aside>

## api_users_id_delete

<a id="opIdapi_users_id_delete"></a>

> Code samples

```javascript

const headers = {
  'Accept':'application/ld+json'
};

fetch('/api/users/{id}',
{
  method: 'DELETE',

  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('DELETE','/api/users/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`DELETE /api/users/{id}`

*Removes the User resource.*

Removes the User resource.

<h3 id="api_users_id_delete-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|User identifier|

> Example responses

> 403 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}
```

<h3 id="api_users_id_delete-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|204|[No Content](https://tools.ietf.org/html/rfc7231#section-6.3.5)|User resource deleted|None|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbidden|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|

<aside class="success">
This operation does not require authentication
</aside>

## api_users_id_patch

<a id="opIdapi_users_id_patch"></a>

> Code samples

```javascript
const inputBody = '{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}';
const headers = {
  'Content-Type':'application/merge-patch+json',
  'Accept':'application/ld+json'
};

fetch('/api/users/{id}',
{
  method: 'PATCH',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/merge-patch+json',
    'Accept' => 'application/ld+json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('PATCH','/api/users/{id}', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`PATCH /api/users/{id}`

*Mise à jour d'un utilisateur*

Modification d'un utilisateur avec possibilité de ne pas modifier le mot de passe

> Body parameter

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}
```

<h3 id="api_users_id_patch-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|id|path|string|true|User identifier|
|body|body|[User.UserUpdateInput-user.update](#schemauser.userupdateinput-user.update)|true|The updated User resource|

> Example responses

> 200 Response

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "email": "string",
  "roles": [
    "string"
  ],
  "password": "string",
  "plainPassword": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "missions": [
    "https://example.com/"
  ],
  "missionSubmissions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "school": "https://example.com/",
  "schoolId": 0,
  "userIdentifier": "string",
  "schoolName": "string",
  "fullName": "string"
}
```

<h3 id="api_users_id_patch-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|User resource updated|[User.jsonschema](#schemauser.jsonschema)|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Invalid input|[Error](#schemaerror)|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbidden|[Error](#schemaerror)|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|[Error](#schemaerror)|
|422|[Unprocessable Entity](https://tools.ietf.org/html/rfc2518#section-10.3)|An error occurred|[ConstraintViolation-json](#schemaconstraintviolation-json)|

<aside class="success">
This operation does not require authentication
</aside>

<h1 id="eduservice-api-login-check">Login Check</h1>

## login_check_post

<a id="opIdlogin_check_post"></a>

> Code samples

```javascript
const inputBody = '{
  "email": "string",
  "password": "string"
}';
const headers = {
  'Content-Type':'application/json',
  'Accept':'application/json'
};

fetch('/api/login',
{
  method: 'POST',
  body: inputBody,
  headers: headers
})
.then(function(res) {
    return res.json();
}).then(function(body) {
    console.log(body);
});

```

```php
<?php

require 'vendor/autoload.php';

$headers = array(
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
);

$client = new \GuzzleHttp\Client();

// Define array of request body.
$request_body = array();

try {
    $response = $client->request('POST','/api/login', array(
        'headers' => $headers,
        'json' => $request_body,
       )
    );
    print_r($response->getBody()->getContents());
 }
 catch (\GuzzleHttp\Exception\BadResponseException $e) {
    // handle exception or api errors.
    print_r($e->getMessage());
 }

 // ...

```

`POST /api/login`

*Creates a user token.*

Creates a user token.

> Body parameter

```json
{
  "email": "string",
  "password": "string"
}
```

<h3 id="login_check_post-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|object|true|The login data|
|» email|body|string|true|none|
|» password|body|string|true|none|

> Example responses

> 200 Response

```json
{
  "token": "string"
}
```

<h3 id="login_check_post-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|User token created|Inline|

<h3 id="login_check_post-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» token|string|true|read-only|none|

<aside class="success">
This operation does not require authentication
</aside>

# Schemas

<h2 id="tocS_Challenge">Challenge</h2>
<!-- backwards compatibility -->
<a id="schemachallenge"></a>
<a id="schema_Challenge"></a>
<a id="tocSchallenge"></a>
<a id="tocschallenge"></a>

```json
{
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|academicYear|string|false|none|none|
|missions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|missionEnd|string(date-time)|false|none|none|
|sponsorshipEnd|string(date-time)|false|none|none|

<h2 id="tocS_Challenge.jsonld">Challenge.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemachallenge.jsonld"></a>
<a id="schema_Challenge.jsonld"></a>
<a id="tocSchallenge.jsonld"></a>
<a id="tocschallenge.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|academicYear|string|false|none|none|
|missions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|missionEnd|string(date-time)|false|none|none|
|sponsorshipEnd|string(date-time)|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_Challenge.jsonopenapi">Challenge.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemachallenge.jsonopenapi"></a>
<a id="schema_Challenge.jsonopenapi"></a>
<a id="tocSchallenge.jsonopenapi"></a>
<a id="tocschallenge.jsonopenapi"></a>

```json
{
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|academicYear|string|false|none|none|
|missions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|missionEnd|string(date-time)|false|none|none|
|sponsorshipEnd|string(date-time)|false|none|none|

<h2 id="tocS_Challenge.jsonschema">Challenge.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemachallenge.jsonschema"></a>
<a id="schema_Challenge.jsonschema"></a>
<a id="tocSchallenge.jsonschema"></a>
<a id="tocschallenge.jsonschema"></a>

```json
{
  "id": 0,
  "academicYear": "string",
  "missions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "missionEnd": "2019-08-24T14:15:22Z",
  "sponsorshipEnd": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|academicYear|string|false|none|none|
|missions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|missionEnd|string(date-time)|false|none|none|
|sponsorshipEnd|string(date-time)|false|none|none|

<h2 id="tocS_ConstraintViolation-json">ConstraintViolation-json</h2>
<!-- backwards compatibility -->
<a id="schemaconstraintviolation-json"></a>
<a id="schema_ConstraintViolation-json"></a>
<a id="tocSconstraintviolation-json"></a>
<a id="tocsconstraintviolation-json"></a>

```json
{
  "status": 422,
  "violations": [
    {
      "propertyPath": "string",
      "message": "string"
    }
  ],
  "detail": "string",
  "type": "string",
  "title": "string",
  "instance": "string"
}

```

Unprocessable entity

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|status|integer|false|none|none|
|violations|[object]|false|none|none|
|» propertyPath|string|false|none|The property path of the violation|
|» message|string|false|none|The message associated with the violation|
|detail|string|false|read-only|none|
|type|string|false|read-only|none|
|title|string,null|false|read-only|none|
|instance|string,null|false|read-only|none|

<h2 id="tocS_ConstraintViolation.jsonld-jsonld">ConstraintViolation.jsonld-jsonld</h2>
<!-- backwards compatibility -->
<a id="schemaconstraintviolation.jsonld-jsonld"></a>
<a id="schema_ConstraintViolation.jsonld-jsonld"></a>
<a id="tocSconstraintviolation.jsonld-jsonld"></a>
<a id="tocsconstraintviolation.jsonld-jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "status": 422,
  "violations": [
    {
      "propertyPath": "string",
      "message": "string"
    }
  ],
  "detail": "string",
  "description": "string",
  "type": "string",
  "title": "string",
  "instance": "string"
}

```

Unprocessable entity

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|status|integer|false|none|none|
|violations|[object]|false|none|none|
|» propertyPath|string|false|none|The property path of the violation|
|» message|string|false|none|The message associated with the violation|
|detail|string|false|read-only|none|
|description|string|false|read-only|none|
|type|string|false|read-only|none|
|title|string,null|false|read-only|none|
|instance|string,null|false|read-only|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_Error">Error</h2>
<!-- backwards compatibility -->
<a id="schemaerror"></a>
<a id="schema_Error"></a>
<a id="tocSerror"></a>
<a id="tocserror"></a>

```json
{
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string"
}

```

A representation of common errors.

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|title|string,null|false|read-only|A short, human-readable summary of the problem.|
|detail|string,null|false|read-only|A human-readable explanation specific to this occurrence of the problem.|
|status|number|false|none|none|
|instance|string,null|false|read-only|A URI reference that identifies the specific occurrence of the problem. It may or may not yield further information if dereferenced.|
|type|string|false|read-only|A URI reference that identifies the problem type|

<h2 id="tocS_Error.jsonld">Error.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemaerror.jsonld"></a>
<a id="schema_Error.jsonld"></a>
<a id="tocSerror.jsonld"></a>
<a id="tocserror.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "title": "string",
  "detail": "string",
  "status": 404,
  "instance": "string",
  "type": "string",
  "description": "string"
}

```

A representation of common errors.

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|title|string,null|false|read-only|A short, human-readable summary of the problem.|
|detail|string,null|false|read-only|A human-readable explanation specific to this occurrence of the problem.|
|status|number|false|none|none|
|instance|string,null|false|read-only|A URI reference that identifies the specific occurrence of the problem. It may or may not yield further information if dereferenced.|
|type|string|false|read-only|A URI reference that identifies the problem type|
|description|string,null|false|read-only|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_Mission">Mission</h2>
<!-- backwards compatibility -->
<a id="schemamission"></a>
<a id="schema_Mission"></a>
<a id="tocSmission"></a>
<a id="tocsmission"></a>

```json
{
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|description|string|false|none|none|
|points|integer|false|none|none|
|challenge|string(iri-reference)|false|none|none|
|admin|string(iri-reference)|false|none|none|
|repeatable|boolean|false|none|none|
|requiresProof|boolean|false|none|none|
|maxRepetitions|integer,null|false|none|none|
|status|string|false|none|none|
|missionSubmissions|[string]|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|created|
|status|active|
|status|paused|
|status|completed|

<h2 id="tocS_Mission.jsonld">Mission.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemamission.jsonld"></a>
<a id="schema_Mission.jsonld"></a>
<a id="tocSmission.jsonld"></a>
<a id="tocsmission.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|description|string|false|none|none|
|points|integer|false|none|none|
|challenge|string(iri-reference)|false|none|none|
|admin|string(iri-reference)|false|none|none|
|repeatable|boolean|false|none|none|
|requiresProof|boolean|false|none|none|
|maxRepetitions|integer,null|false|none|none|
|status|string|false|none|none|
|missionSubmissions|[string]|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|
|status|created|
|status|active|
|status|paused|
|status|completed|

<h2 id="tocS_Mission.jsonopenapi">Mission.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemamission.jsonopenapi"></a>
<a id="schema_Mission.jsonopenapi"></a>
<a id="tocSmission.jsonopenapi"></a>
<a id="tocsmission.jsonopenapi"></a>

```json
{
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|description|string|false|none|none|
|points|integer|false|none|none|
|challenge|string(iri-reference)|false|none|none|
|admin|string(iri-reference)|false|none|none|
|repeatable|boolean|false|none|none|
|requiresProof|boolean|false|none|none|
|maxRepetitions|integer,null|false|none|none|
|status|string|false|none|none|
|missionSubmissions|[string]|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|created|
|status|active|
|status|paused|
|status|completed|

<h2 id="tocS_Mission.jsonschema">Mission.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemamission.jsonschema"></a>
<a id="schema_Mission.jsonschema"></a>
<a id="tocSmission.jsonschema"></a>
<a id="tocsmission.jsonschema"></a>

```json
{
  "id": 0,
  "name": "string",
  "description": "string",
  "points": 0,
  "challenge": "https://example.com/",
  "admin": "https://example.com/",
  "repeatable": true,
  "requiresProof": true,
  "maxRepetitions": 0,
  "status": "created",
  "missionSubmissions": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|description|string|false|none|none|
|points|integer|false|none|none|
|challenge|string(iri-reference)|false|none|none|
|admin|string(iri-reference)|false|none|none|
|repeatable|boolean|false|none|none|
|requiresProof|boolean|false|none|none|
|maxRepetitions|integer,null|false|none|none|
|status|string|false|none|none|
|missionSubmissions|[string]|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|created|
|status|active|
|status|paused|
|status|completed|

<h2 id="tocS_MissionSubmission">MissionSubmission</h2>
<!-- backwards compatibility -->
<a id="schemamissionsubmission"></a>
<a id="schema_MissionSubmission"></a>
<a id="tocSmissionsubmission"></a>
<a id="tocsmissionsubmission"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string(iri-reference)|false|none|none|
|mission|string,null(iri-reference)|false|none|none|
|proofPath|string,null|false|none|none|
|status|string|false|none|none|
|rejectionReason|string,null|false|none|none|
|admin|string,null(iri-reference)|false|none|none|
|submissionDate|string(date-time)|false|none|none|
|validationDate|string,null(date-time)|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|submitted|
|status|approved|
|status|rejected|

<h2 id="tocS_MissionSubmission.jsonld">MissionSubmission.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemamissionsubmission.jsonld"></a>
<a id="schema_MissionSubmission.jsonld"></a>
<a id="tocSmissionsubmission.jsonld"></a>
<a id="tocsmissionsubmission.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|ambassador|string(iri-reference)|false|none|none|
|mission|string,null(iri-reference)|false|none|none|
|proofPath|string,null|false|none|none|
|status|string|false|none|none|
|rejectionReason|string,null|false|none|none|
|admin|string,null(iri-reference)|false|none|none|
|submissionDate|string(date-time)|false|none|none|
|validationDate|string,null(date-time)|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|
|status|submitted|
|status|approved|
|status|rejected|

<h2 id="tocS_MissionSubmission.jsonopenapi">MissionSubmission.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemamissionsubmission.jsonopenapi"></a>
<a id="schema_MissionSubmission.jsonopenapi"></a>
<a id="tocSmissionsubmission.jsonopenapi"></a>
<a id="tocsmissionsubmission.jsonopenapi"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string(iri-reference)|false|none|none|
|mission|string,null(iri-reference)|false|none|none|
|proofPath|string,null|false|none|none|
|status|string|false|none|none|
|rejectionReason|string,null|false|none|none|
|admin|string,null(iri-reference)|false|none|none|
|submissionDate|string(date-time)|false|none|none|
|validationDate|string,null(date-time)|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|submitted|
|status|approved|
|status|rejected|

<h2 id="tocS_MissionSubmission.jsonschema">MissionSubmission.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemamissionsubmission.jsonschema"></a>
<a id="schema_MissionSubmission.jsonschema"></a>
<a id="tocSmissionsubmission.jsonschema"></a>
<a id="tocsmissionsubmission.jsonschema"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "mission": "https://example.com/",
  "proofPath": "string",
  "status": "submitted",
  "rejectionReason": "string",
  "admin": "https://example.com/",
  "submissionDate": "2019-08-24T14:15:22Z",
  "validationDate": "2019-08-24T14:15:22Z"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string(iri-reference)|false|none|none|
|mission|string,null(iri-reference)|false|none|none|
|proofPath|string,null|false|none|none|
|status|string|false|none|none|
|rejectionReason|string,null|false|none|none|
|admin|string,null(iri-reference)|false|none|none|
|submissionDate|string(date-time)|false|none|none|
|validationDate|string,null(date-time)|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|status|submitted|
|status|approved|
|status|rejected|

<h2 id="tocS_Ranking">Ranking</h2>
<!-- backwards compatibility -->
<a id="schemaranking"></a>
<a id="schema_Ranking"></a>
<a id="tocSranking"></a>
<a id="tocsranking"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string,null(iri-reference)|false|none|none|
|challenge|string,null(iri-reference)|false|none|none|
|points|integer|false|none|none|

<h2 id="tocS_Ranking.jsonld">Ranking.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemaranking.jsonld"></a>
<a id="schema_Ranking.jsonld"></a>
<a id="tocSranking.jsonld"></a>
<a id="tocsranking.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|ambassador|string,null(iri-reference)|false|none|none|
|challenge|string,null(iri-reference)|false|none|none|
|points|integer|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_Ranking.jsonopenapi">Ranking.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemaranking.jsonopenapi"></a>
<a id="schema_Ranking.jsonopenapi"></a>
<a id="tocSranking.jsonopenapi"></a>
<a id="tocsranking.jsonopenapi"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string,null(iri-reference)|false|none|none|
|challenge|string,null(iri-reference)|false|none|none|
|points|integer|false|none|none|

<h2 id="tocS_Ranking.jsonschema">Ranking.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemaranking.jsonschema"></a>
<a id="schema_Ranking.jsonschema"></a>
<a id="tocSranking.jsonschema"></a>
<a id="tocsranking.jsonschema"></a>

```json
{
  "id": 0,
  "ambassador": "https://example.com/",
  "challenge": "https://example.com/",
  "points": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|ambassador|string,null(iri-reference)|false|none|none|
|challenge|string,null(iri-reference)|false|none|none|
|points|integer|false|none|none|

<h2 id="tocS_Rankings.RankingOutput">Rankings.RankingOutput</h2>
<!-- backwards compatibility -->
<a id="schemarankings.rankingoutput"></a>
<a id="schema_Rankings.RankingOutput"></a>
<a id="tocSrankings.rankingoutput"></a>
<a id="tocsrankings.rankingoutput"></a>

```json
{
  "rank": 0,
  "ambassadorFullName": "string",
  "points": 0,
  "school": "string",
  "schoolYear": "string",
  "rewards": [
    "string"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|rank|integer|false|none|none|
|ambassadorFullName|string|false|none|none|
|points|integer|false|none|none|
|school|string,null|false|none|none|
|schoolYear|string,null|false|none|none|
|rewards|[string]|false|none|none|

<h2 id="tocS_Rankings.RankingOutput.jsonld">Rankings.RankingOutput.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemarankings.rankingoutput.jsonld"></a>
<a id="schema_Rankings.RankingOutput.jsonld"></a>
<a id="tocSrankings.rankingoutput.jsonld"></a>
<a id="tocsrankings.rankingoutput.jsonld"></a>

```json
{
  "@id": "string",
  "@type": "string",
  "rank": 0,
  "ambassadorFullName": "string",
  "points": 0,
  "school": "string",
  "schoolYear": "string",
  "rewards": [
    "string"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|rank|integer|false|none|none|
|ambassadorFullName|string|false|none|none|
|points|integer|false|none|none|
|school|string,null|false|none|none|
|schoolYear|string,null|false|none|none|
|rewards|[string]|false|none|none|

<h2 id="tocS_Rankings.RankingOutput.jsonopenapi">Rankings.RankingOutput.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemarankings.rankingoutput.jsonopenapi"></a>
<a id="schema_Rankings.RankingOutput.jsonopenapi"></a>
<a id="tocSrankings.rankingoutput.jsonopenapi"></a>
<a id="tocsrankings.rankingoutput.jsonopenapi"></a>

```json
{
  "rank": 0,
  "ambassadorFullName": "string",
  "points": 0,
  "school": "string",
  "schoolYear": "string",
  "rewards": [
    "string"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|rank|integer|false|none|none|
|ambassadorFullName|string|false|none|none|
|points|integer|false|none|none|
|school|string,null|false|none|none|
|schoolYear|string,null|false|none|none|
|rewards|[string]|false|none|none|

<h2 id="tocS_Rankings.RankingOutput.jsonschema">Rankings.RankingOutput.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemarankings.rankingoutput.jsonschema"></a>
<a id="schema_Rankings.RankingOutput.jsonschema"></a>
<a id="tocSrankings.rankingoutput.jsonschema"></a>
<a id="tocsrankings.rankingoutput.jsonschema"></a>

```json
{
  "rank": 0,
  "ambassadorFullName": "string",
  "points": 0,
  "school": "string",
  "schoolYear": "string",
  "rewards": [
    "string"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|rank|integer|false|none|none|
|ambassadorFullName|string|false|none|none|
|points|integer|false|none|none|
|school|string,null|false|none|none|
|schoolYear|string,null|false|none|none|
|rewards|[string]|false|none|none|

<h2 id="tocS_School">School</h2>
<!-- backwards compatibility -->
<a id="schemaschool"></a>
<a id="schema_School"></a>
<a id="tocSschool"></a>
<a id="tocsschool"></a>

```json
{
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|users|[string]|false|none|none|

<h2 id="tocS_School.jsonld">School.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemaschool.jsonld"></a>
<a id="schema_School.jsonld"></a>
<a id="tocSschool.jsonld"></a>
<a id="tocsschool.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|users|[string]|false|none|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_School.jsonopenapi">School.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemaschool.jsonopenapi"></a>
<a id="schema_School.jsonopenapi"></a>
<a id="tocSschool.jsonopenapi"></a>
<a id="tocsschool.jsonopenapi"></a>

```json
{
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|users|[string]|false|none|none|

<h2 id="tocS_School.jsonschema">School.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemaschool.jsonschema"></a>
<a id="schema_School.jsonschema"></a>
<a id="tocSschool.jsonschema"></a>
<a id="tocsschool.jsonschema"></a>

```json
{
  "id": 0,
  "name": "string",
  "users": [
    "https://example.com/"
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|name|string|false|none|none|
|users|[string]|false|none|none|

<h2 id="tocS_User">User</h2>
<!-- backwards compatibility -->
<a id="schemauser"></a>
<a id="schema_User"></a>
<a id="tocSuser"></a>
<a id="tocsuser"></a>

```json
{
  "id": 0,
  "email": "string",
  "roles": [
    "string"
  ],
  "password": "string",
  "plainPassword": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "missions": [
    "https://example.com/"
  ],
  "missionSubmissions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "school": "https://example.com/",
  "schoolId": 0,
  "userIdentifier": "string",
  "schoolName": "string",
  "fullName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|email|string|false|none|none|
|roles|[string]|false|none|The user roles|
|password|string|false|none|The hashed password|
|plainPassword|string,null|false|none|Get the plain password (non-persisted field)|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|missions|[string]|false|none|none|
|missionSubmissions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|school|string(iri-reference)|false|none|none|
|schoolId|integer,null|false|none|none|
|userIdentifier|string|false|read-only|A visual identifier that represents this user.|
|schoolName|string,null|false|read-only|none|
|fullName|string|false|read-only|none|

<h2 id="tocS_User-user.read">User-user.read</h2>
<!-- backwards compatibility -->
<a id="schemauser-user.read"></a>
<a id="schema_User-user.read"></a>
<a id="tocSuser-user.read"></a>
<a id="tocsuser-user.read"></a>

```json
{
  "school": "https://example.com/",
  "schoolName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|school|string(iri-reference)|false|none|none|
|schoolName|string,null|false|read-only|none|

<h2 id="tocS_User.UserInput-user.write">User.UserInput-user.write</h2>
<!-- backwards compatibility -->
<a id="schemauser.userinput-user.write"></a>
<a id="schema_User.UserInput-user.write"></a>
<a id="tocSuser.userinput-user.write"></a>
<a id="tocsuser.userinput-user.write"></a>

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|email|string|false|none|none|
|password|string|false|none|none|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|school|integer|true|none|none|

<h2 id="tocS_User.UserInput.jsonld-user.write">User.UserInput.jsonld-user.write</h2>
<!-- backwards compatibility -->
<a id="schemauser.userinput.jsonld-user.write"></a>
<a id="schema_User.UserInput.jsonld-user.write"></a>
<a id="tocSuser.userinput.jsonld-user.write"></a>
<a id="tocsuser.userinput.jsonld-user.write"></a>

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|email|string|false|none|none|
|password|string|false|none|none|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|school|integer|true|none|none|

<h2 id="tocS_User.UserInput.jsonopenapi-user.write">User.UserInput.jsonopenapi-user.write</h2>
<!-- backwards compatibility -->
<a id="schemauser.userinput.jsonopenapi-user.write"></a>
<a id="schema_User.UserInput.jsonopenapi-user.write"></a>
<a id="tocSuser.userinput.jsonopenapi-user.write"></a>
<a id="tocsuser.userinput.jsonopenapi-user.write"></a>

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|email|string|false|none|none|
|password|string|false|none|none|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|school|integer|true|none|none|

<h2 id="tocS_User.UserInput.jsonschema-user.write">User.UserInput.jsonschema-user.write</h2>
<!-- backwards compatibility -->
<a id="schemauser.userinput.jsonschema-user.write"></a>
<a id="schema_User.UserInput.jsonschema-user.write"></a>
<a id="tocSuser.userinput.jsonschema-user.write"></a>
<a id="tocsuser.userinput.jsonschema-user.write"></a>

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|email|string|false|none|none|
|password|string|false|none|none|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|school|integer|true|none|none|

<h2 id="tocS_User.UserUpdateInput-user.update">User.UserUpdateInput-user.update</h2>
<!-- backwards compatibility -->
<a id="schemauser.userupdateinput-user.update"></a>
<a id="schema_User.UserUpdateInput-user.update"></a>
<a id="tocSuser.userupdateinput-user.update"></a>
<a id="tocsuser.userupdateinput-user.update"></a>

```json
{
  "email": "string",
  "password": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "school": 0
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|email|string,null|false|none|none|
|password|string,null|false|none|none|
|firstName|string,null|false|none|none|
|lastName|string,null|false|none|none|
|phoneNumber|string,null|false|none|none|
|school|integer,null|false|none|none|

<h2 id="tocS_User.jsonld">User.jsonld</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonld"></a>
<a id="schema_User.jsonld"></a>
<a id="tocSuser.jsonld"></a>
<a id="tocsuser.jsonld"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "id": 0,
  "email": "string",
  "roles": [
    "string"
  ],
  "password": "string",
  "plainPassword": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "missions": [
    "https://example.com/"
  ],
  "missionSubmissions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "school": "https://example.com/",
  "schoolId": 0,
  "userIdentifier": "string",
  "schoolName": "string",
  "fullName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|id|integer|false|read-only|none|
|email|string|false|none|none|
|roles|[string]|false|none|The user roles|
|password|string|false|none|The hashed password|
|plainPassword|string,null|false|none|Get the plain password (non-persisted field)|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|missions|[string]|false|none|none|
|missionSubmissions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|school|string(iri-reference)|false|none|none|
|schoolId|integer,null|false|none|none|
|userIdentifier|string|false|read-only|A visual identifier that represents this user.|
|schoolName|string,null|false|read-only|none|
|fullName|string|false|read-only|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_User.jsonld-user.read">User.jsonld-user.read</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonld-user.read"></a>
<a id="schema_User.jsonld-user.read"></a>
<a id="tocSuser.jsonld-user.read"></a>
<a id="tocsuser.jsonld-user.read"></a>

```json
{
  "@context": "string",
  "@id": "string",
  "@type": "string",
  "school": "https://example.com/",
  "schoolName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@context|any|false|read-only|none|

oneOf

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|string|false|none|none|

xor

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» *anonymous*|object|false|none|none|
|»» @vocab|string|true|none|none|
|»» hydra|string|true|none|none|

continued

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|@id|string|false|read-only|none|
|@type|string|false|read-only|none|
|school|string(iri-reference)|false|none|none|
|schoolName|string,null|false|read-only|none|

#### Enumerated Values

|Property|Value|
|---|---|
|hydra|http://www.w3.org/ns/hydra/core#|

<h2 id="tocS_User.jsonopenapi">User.jsonopenapi</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonopenapi"></a>
<a id="schema_User.jsonopenapi"></a>
<a id="tocSuser.jsonopenapi"></a>
<a id="tocsuser.jsonopenapi"></a>

```json
{
  "id": 0,
  "email": "string",
  "roles": [
    "string"
  ],
  "password": "string",
  "plainPassword": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "missions": [
    "https://example.com/"
  ],
  "missionSubmissions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "school": "https://example.com/",
  "schoolId": 0,
  "userIdentifier": "string",
  "schoolName": "string",
  "fullName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|email|string|false|none|none|
|roles|[string]|false|none|The user roles|
|password|string|false|none|The hashed password|
|plainPassword|string,null|false|none|Get the plain password (non-persisted field)|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|missions|[string]|false|none|none|
|missionSubmissions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|school|string(iri-reference)|false|none|none|
|schoolId|integer,null|false|none|none|
|userIdentifier|string|false|read-only|A visual identifier that represents this user.|
|schoolName|string,null|false|read-only|none|
|fullName|string|false|read-only|none|

<h2 id="tocS_User.jsonopenapi-user.read">User.jsonopenapi-user.read</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonopenapi-user.read"></a>
<a id="schema_User.jsonopenapi-user.read"></a>
<a id="tocSuser.jsonopenapi-user.read"></a>
<a id="tocsuser.jsonopenapi-user.read"></a>

```json
{
  "school": "https://example.com/",
  "schoolName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|school|string(iri-reference)|false|none|none|
|schoolName|string,null|false|read-only|none|

<h2 id="tocS_User.jsonschema">User.jsonschema</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonschema"></a>
<a id="schema_User.jsonschema"></a>
<a id="tocSuser.jsonschema"></a>
<a id="tocsuser.jsonschema"></a>

```json
{
  "id": 0,
  "email": "string",
  "roles": [
    "string"
  ],
  "password": "string",
  "plainPassword": "string",
  "firstName": "string",
  "lastName": "string",
  "phoneNumber": "string",
  "missions": [
    "https://example.com/"
  ],
  "missionSubmissions": [
    "https://example.com/"
  ],
  "rankings": [
    "https://example.com/"
  ],
  "school": "https://example.com/",
  "schoolId": 0,
  "userIdentifier": "string",
  "schoolName": "string",
  "fullName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|integer|false|read-only|none|
|email|string|false|none|none|
|roles|[string]|false|none|The user roles|
|password|string|false|none|The hashed password|
|plainPassword|string,null|false|none|Get the plain password (non-persisted field)|
|firstName|string|false|none|none|
|lastName|string|false|none|none|
|phoneNumber|string,null|false|none|none|
|missions|[string]|false|none|none|
|missionSubmissions|[string]|false|none|none|
|rankings|[string]|false|none|none|
|school|string(iri-reference)|false|none|none|
|schoolId|integer,null|false|none|none|
|userIdentifier|string|false|read-only|A visual identifier that represents this user.|
|schoolName|string,null|false|read-only|none|
|fullName|string|false|read-only|none|

<h2 id="tocS_User.jsonschema-user.read">User.jsonschema-user.read</h2>
<!-- backwards compatibility -->
<a id="schemauser.jsonschema-user.read"></a>
<a id="schema_User.jsonschema-user.read"></a>
<a id="tocSuser.jsonschema-user.read"></a>
<a id="tocsuser.jsonschema-user.read"></a>

```json
{
  "school": "https://example.com/",
  "schoolName": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|school|string(iri-reference)|false|none|none|
|schoolName|string,null|false|read-only|none|

