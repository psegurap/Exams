@extends('layouts.main')
@section('title')Exámenes @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right border-bottom pb-3">
                    <a :href="homepath + '/examenes/create'">
                        <button class="btn btn-info">Crear Examen</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Header 1</th>
                            <th>Header 2</th>
                            <th>Header 3</th>
                            <th>Header 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>nemo amet nisi</td>
                            <td>enim pariatur rerum</td>
                            <td>eum doloremque ex</td>
                            <td>minima voluptas dolores</td>
                        </tr>
                        <tr>
                            <td>voluptatem et et</td>
                            <td>neque dolore ut</td>
                            <td>saepe id minima</td>
                            <td>incidunt aliquam laudantium</td>
                        </tr>
                        <tr>
                            <td>blanditiis quibusdam sint</td>
                            <td>provident architecto et</td>
                            <td>iste culpa pariatur</td>
                            <td>atque dolores vitae</td>
                        </tr>
                        <tr>
                            <td>qui neque qui</td>
                            <td>ab et officia</td>
                            <td>aperiam officiis eaque</td>
                            <td>necessitatibus cum ipsum</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        var main = new Vue({
            el: 'main',
            data: {

            },
            mounted: function(){
                var data = [
                    {   
                    "gender": "female",
                    "name": {
                        "title": "Miss",
                        "first": "Saana",
                        "last": "Wirtanen"
                    },
                    "location": {
                        "street": {
                        "number": 2777,
                        "name": "Aleksanterinkatu"
                        },
                        "city": "Joutsa",
                        "state": "South Karelia",
                        "country": "Finland",
                        "postcode": 45216,
                        "coordinates": {
                        "latitude": "-12.6865",
                        "longitude": "52.0512"
                        },
                        "timezone": {
                        "offset": "+9:30",
                        "description": "Adelaide, Darwin"
                        }
                    },
                    "email": "saana.wirtanen@example.com",
                    "login": {
                        "uuid": "df1e403b-6b82-4eb8-af3a-183769d4866f",
                        "username": "purplebutterfly554",
                        "password": "chocha",
                        "salt": "RIi4TGh8",
                        "md5": "b4ca501846ede6161f989b0b4e0ed8dc",
                        "sha1": "4c685da9d09230c306581c931addb5ec19a79685",
                        "sha256": "d0f4ab13981c2b5b65ba04963b4888321fc3c3647c6c00413ff32da484e62eab"
                    },
                    "dob": {
                        "date": "1954-11-21T05:54:00.606Z",
                        "age": 66
                    },
                    "registered": {
                        "date": "2010-01-07T07:18:17.958Z",
                        "age": 10
                    },
                    "phone": "06-825-349",
                    "cell": "046-971-87-85",
                    "id": {
                        "name": "HETU",
                        "value": "NaNNA396undefined"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/37.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/37.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/37.jpg"
                    },
                    "nat": "FI"
                    },
                    {
                    "gender": "male",
                    "name": {
                        "title": "Mr",
                        "first": "Fahim",
                        "last": "Van Lieshout"
                    },
                    "location": {
                        "street": {
                        "number": 8773,
                        "name": "Keijenhurkseweg"
                        },
                        "city": "'t Zandt Gn",
                        "state": "Noord-Brabant",
                        "country": "Netherlands",
                        "postcode": 96639,
                        "coordinates": {
                        "latitude": "22.0875",
                        "longitude": "164.7987"
                        },
                        "timezone": {
                        "offset": "+3:00",
                        "description": "Baghdad, Riyadh, Moscow, St. Petersburg"
                        }
                    },
                    "email": "fahim.vanlieshout@example.com",
                    "login": {
                        "uuid": "b2cce84e-9b64-4d8e-a08f-c12344ce96ae",
                        "username": "happyostrich937",
                        "password": "miles",
                        "salt": "UfjorqW5",
                        "md5": "9ac529a6a3034f9294b442d3400f6ef2",
                        "sha1": "ce5e12694fcb0cb12432b4ffbebfde1412385860",
                        "sha256": "56c0cd98a2c8de3f50e61bc631e575a93294574edec4bddb7c85daaf1fcddfed"
                    },
                    "dob": {
                        "date": "1982-09-30T11:57:30.729Z",
                        "age": 38
                    },
                    "registered": {
                        "date": "2016-05-11T10:39:06.563Z",
                        "age": 4
                    },
                    "phone": "(335)-251-0618",
                    "cell": "(947)-613-7737",
                    "id": {
                        "name": "BSN",
                        "value": "01765567"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/men/77.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/men/77.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/men/77.jpg"
                    },
                    "nat": "NL"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Ms",
                        "first": "Margaux",
                        "last": "Muller"
                    },
                    "location": {
                        "street": {
                        "number": 5068,
                        "name": "Rue Louis-Garrand"
                        },
                        "city": "Rennes",
                        "state": "Alpes-Maritimes",
                        "country": "France",
                        "postcode": 30936,
                        "coordinates": {
                        "latitude": "36.7591",
                        "longitude": "110.6481"
                        },
                        "timezone": {
                        "offset": "-9:00",
                        "description": "Alaska"
                        }
                    },
                    "email": "margaux.muller@example.com",
                    "login": {
                        "uuid": "c5683820-92df-47c9-a5bb-5b01cb89ac7c",
                        "username": "beautifulostrich746",
                        "password": "yankee",
                        "salt": "YRx1Qbcn",
                        "md5": "aa40fde3b8bde7caf13134360447bf3b",
                        "sha1": "58a8396c93f985aded7c930772e05b9c3798082f",
                        "sha256": "bbcef792f4bc35bb0328b99e2f6dc9f91d1706056df226fc6c5723aa04523879"
                    },
                    "dob": {
                        "date": "1948-12-01T00:21:39.524Z",
                        "age": 72
                    },
                    "registered": {
                        "date": "2019-05-14T12:05:08.275Z",
                        "age": 1
                    },
                    "phone": "02-27-06-83-92",
                    "cell": "06-03-54-93-82",
                    "id": {
                        "name": "INSEE",
                        "value": "2NNaN38326114 33"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/81.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/81.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/81.jpg"
                    },
                    "nat": "FR"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Ms",
                        "first": "Zoé",
                        "last": "Bertrand"
                    },
                    "location": {
                        "street": {
                        "number": 9019,
                        "name": "Rue Duquesne"
                        },
                        "city": "Aubervilliers",
                        "state": "Ille-et-Vilaine",
                        "country": "France",
                        "postcode": 97393,
                        "coordinates": {
                        "latitude": "33.9064",
                        "longitude": "85.6549"
                        },
                        "timezone": {
                        "offset": "+8:00",
                        "description": "Beijing, Perth, Singapore, Hong Kong"
                        }
                    },
                    "email": "zoe.bertrand@example.com",
                    "login": {
                        "uuid": "d18ec03c-b6da-4003-b1ab-1fd53b09e5f4",
                        "username": "blueladybug333",
                        "password": "fossil",
                        "salt": "6LTBtlMm",
                        "md5": "8e5b4569db305ac988283e9975b56c97",
                        "sha1": "27cd8efffe5f5242aed95070904474e1e02ad9df",
                        "sha256": "7aeeaa10e52152a819e325e55f5da7b6baee85f7bd3d701695c5198e3060a79e"
                    },
                    "dob": {
                        "date": "1990-10-25T21:11:37.627Z",
                        "age": 30
                    },
                    "registered": {
                        "date": "2012-02-17T05:40:12.037Z",
                        "age": 8
                    },
                    "phone": "02-93-08-94-36",
                    "cell": "06-27-00-18-11",
                    "id": {
                        "name": "INSEE",
                        "value": "2NNaN25605357 96"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/12.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/12.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/12.jpg"
                    },
                    "nat": "FR"
                    },
                    {
                    "gender": "male",
                    "name": {
                        "title": "Mr",
                        "first": "Johan",
                        "last": "Brun"
                    },
                    "location": {
                        "street": {
                        "number": 8777,
                        "name": "Avenue des Ternes"
                        },
                        "city": "Aulnay-sous-Bois",
                        "state": "Tarn-et-Garonne",
                        "country": "France",
                        "postcode": 27982,
                        "coordinates": {
                        "latitude": "-80.8069",
                        "longitude": "-55.2872"
                        },
                        "timezone": {
                        "offset": "+3:30",
                        "description": "Tehran"
                        }
                    },
                    "email": "johan.brun@example.com",
                    "login": {
                        "uuid": "87f5e35d-5392-4276-a7ef-1adee17fe9b7",
                        "username": "heavykoala415",
                        "password": "raining",
                        "salt": "ynrhgAUY",
                        "md5": "a41b6243ed85f1f35fe874b44d6c951a",
                        "sha1": "d981a511bf7275dd4936c5ea1490c3bebd111b71",
                        "sha256": "5e4bfb238a0658fc5ad1942626c33f8a91d51ca3b9128cbadf18137b4be28baa"
                    },
                    "dob": {
                        "date": "1955-08-15T11:32:30.455Z",
                        "age": 65
                    },
                    "registered": {
                        "date": "2014-08-05T00:13:59.086Z",
                        "age": 6
                    },
                    "phone": "04-75-24-22-51",
                    "cell": "06-00-46-11-40",
                    "id": {
                        "name": "INSEE",
                        "value": "1NNaN67698534 71"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/men/28.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/men/28.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/men/28.jpg"
                    },
                    "nat": "FR"
                    },
                    {
                    "gender": "male",
                    "name": {
                        "title": "Mr",
                        "first": "سورنا",
                        "last": "كامياران"
                    },
                    "location": {
                        "street": {
                        "number": 9254,
                        "name": "پاتریس لومومبا"
                        },
                        "city": "قائم‌شهر",
                        "state": "بوشهر",
                        "country": "Iran",
                        "postcode": 95484,
                        "coordinates": {
                        "latitude": "-34.3473",
                        "longitude": "-115.8816"
                        },
                        "timezone": {
                        "offset": "+4:30",
                        "description": "Kabul"
                        }
                    },
                    "email": "swrn.kmyrn@example.com",
                    "login": {
                        "uuid": "935374d9-26f5-40ef-a694-c113c2138918",
                        "username": "crazycat269",
                        "password": "glock",
                        "salt": "pA0vmabF",
                        "md5": "de48dbebafa12fe3cfd39d78acd7d122",
                        "sha1": "68d01540d026c2063e01acf729c8faaf6580a841",
                        "sha256": "7fae3314449e254f733616cbdd3c72a37649699fc5d7d23b492c0fd45f57a518"
                    },
                    "dob": {
                        "date": "1990-05-04T21:05:00.167Z",
                        "age": 30
                    },
                    "registered": {
                        "date": "2011-12-28T13:41:27.215Z",
                        "age": 9
                    },
                    "phone": "042-14516027",
                    "cell": "0968-728-9136",
                    "id": {
                        "name": "",
                        "value": null
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/men/79.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/men/79.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/men/79.jpg"
                    },
                    "nat": "IR"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Miss",
                        "first": "Marjorie",
                        "last": "Harrison"
                    },
                    "location": {
                        "street": {
                        "number": 575,
                        "name": "Poplar Dr"
                        },
                        "city": "Orange",
                        "state": "South Australia",
                        "country": "Australia",
                        "postcode": 2412,
                        "coordinates": {
                        "latitude": "-26.8049",
                        "longitude": "24.2167"
                        },
                        "timezone": {
                        "offset": "+11:00",
                        "description": "Magadan, Solomon Islands, New Caledonia"
                        }
                    },
                    "email": "marjorie.harrison@example.com",
                    "login": {
                        "uuid": "bed86619-e01e-4363-8116-cdb7753b4bb8",
                        "username": "sadleopard575",
                        "password": "cypress",
                        "salt": "5nEMCGb5",
                        "md5": "defda8ec18defd639028dbcefd502c5a",
                        "sha1": "e3250be4a0d3d9d52e2a007881eb72392abb17d9",
                        "sha256": "59415823ffc6c7ef121ef9e8a4efb338a0f740f6fb28cba6cbf9d256aaf10ee4"
                    },
                    "dob": {
                        "date": "1983-06-08T20:43:30.663Z",
                        "age": 37
                    },
                    "registered": {
                        "date": "2007-07-13T12:54:46.643Z",
                        "age": 13
                    },
                    "phone": "00-3261-7630",
                    "cell": "0493-480-891",
                    "id": {
                        "name": "TFN",
                        "value": "613865508"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/69.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/69.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/69.jpg"
                    },
                    "nat": "AU"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Mrs",
                        "first": "Andréa",
                        "last": "Petit"
                    },
                    "location": {
                        "street": {
                        "number": 8404,
                        "name": "Avenue Paul Eluard"
                        },
                        "city": "Paris",
                        "state": "Seine-et-Marne",
                        "country": "France",
                        "postcode": 31240,
                        "coordinates": {
                        "latitude": "-38.9689",
                        "longitude": "-27.2083"
                        },
                        "timezone": {
                        "offset": "+3:00",
                        "description": "Baghdad, Riyadh, Moscow, St. Petersburg"
                        }
                    },
                    "email": "andrea.petit@example.com",
                    "login": {
                        "uuid": "33810169-3260-4aba-ad85-7b3a278aeea3",
                        "username": "happyfrog938",
                        "password": "spartan",
                        "salt": "5M0Aq0QQ",
                        "md5": "b16002a867c43a7b227564bb7912d042",
                        "sha1": "ff6bd05646e3f1d7a5a168b38a118dcd980c35c1",
                        "sha256": "34da3657ef940ba79d95873400e73f6a7bd15a27f0ce51297903388d2644bc7f"
                    },
                    "dob": {
                        "date": "1959-07-22T22:20:52.602Z",
                        "age": 61
                    },
                    "registered": {
                        "date": "2005-04-30T06:00:27.150Z",
                        "age": 15
                    },
                    "phone": "01-19-12-78-07",
                    "cell": "06-80-20-63-30",
                    "id": {
                        "name": "INSEE",
                        "value": "2NNaN50925715 11"
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/64.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/64.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/64.jpg"
                    },
                    "nat": "FR"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Miss",
                        "first": "Keira",
                        "last": "Smith"
                    },
                    "location": {
                        "street": {
                        "number": 4399,
                        "name": "Te Irirangi Drive"
                        },
                        "city": "Whanganui",
                        "state": "Southland",
                        "country": "New Zealand",
                        "postcode": 88903,
                        "coordinates": {
                        "latitude": "80.9699",
                        "longitude": "-90.9271"
                        },
                        "timezone": {
                        "offset": "+1:00",
                        "description": "Brussels, Copenhagen, Madrid, Paris"
                        }
                    },
                    "email": "keira.smith@example.com",
                    "login": {
                        "uuid": "6f530086-423d-48c6-8278-2a14cadc3de1",
                        "username": "whiteduck984",
                        "password": "titanic",
                        "salt": "Lk0KYfIA",
                        "md5": "79f0c7bda1ae6387c40ee3c679117f9a",
                        "sha1": "12ec4bd6a02b87b5d12c594a88bb8e45a97bbf02",
                        "sha256": "fb9d46057571644c6469a8cd1ac777e80c6fc4b1eee31d659a8bb1ab6f13d9ef"
                    },
                    "dob": {
                        "date": "1960-05-17T19:26:52.588Z",
                        "age": 60
                    },
                    "registered": {
                        "date": "2008-01-14T01:09:37.039Z",
                        "age": 12
                    },
                    "phone": "(869)-432-1195",
                    "cell": "(901)-456-6485",
                    "id": {
                        "name": "",
                        "value": null
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/93.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/93.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/93.jpg"
                    },
                    "nat": "NZ"
                    },
                    {
                    "gender": "female",
                    "name": {
                        "title": "Miss",
                        "first": "فاطمه زهرا",
                        "last": "یاسمی"
                    },
                    "location": {
                        "street": {
                        "number": 8840,
                        "name": "جمهوری اسلامی"
                        },
                        "city": "اراک",
                        "state": "مرکزی",
                        "country": "Iran",
                        "postcode": 14872,
                        "coordinates": {
                        "latitude": "-30.2790",
                        "longitude": "54.5804"
                        },
                        "timezone": {
                        "offset": "+7:00",
                        "description": "Bangkok, Hanoi, Jakarta"
                        }
                    },
                    "email": "ftmhzhr.ysmy@example.com",
                    "login": {
                        "uuid": "0da51f0a-a8ee-437a-b80e-4b88b4b054a2",
                        "username": "yellowswan267",
                        "password": "forever",
                        "salt": "dZ9jVolC",
                        "md5": "126c4a489437a317b95f78c2d85ee22c",
                        "sha1": "cb3d6fea10d17ac720ba6a2b26cce392a35c1ba7",
                        "sha256": "8f8a397f6853574b4b8f764736fbe3d2a2fcdc38fb6e89a404f2bde07f50c839"
                    },
                    "dob": {
                        "date": "1951-02-12T06:49:58.086Z",
                        "age": 69
                    },
                    "registered": {
                        "date": "2016-12-17T23:17:17.713Z",
                        "age": 4
                    },
                    "phone": "035-66566839",
                    "cell": "0910-427-5296",
                    "id": {
                        "name": "",
                        "value": null
                    },
                    "picture": {
                        "large": "https://randomuser.me/api/portraits/women/70.jpg",
                        "medium": "https://randomuser.me/api/portraits/med/women/70.jpg",
                        "thumbnail": "https://randomuser.me/api/portraits/thumb/women/70.jpg"
                    },
                    "nat": "IR"
                    }
                ]
            }
        });
        console.log(data)
  
    </script>
@endsection