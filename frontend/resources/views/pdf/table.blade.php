<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 120px 40px 80px 40px;
        }

        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            height: 80px;
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 12px;
        }

        .pagenum:before {
            content: counter(page);
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<header>
    <img height="64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAP1BMVEVHcEz/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSD/LSAV32D4AAAAFHRSTlMABfhB2Rav52DxLYCRcA2+zCBRn1Z9zL0AAAUFSURBVHja7ZvXsqMwDIZpJoHQw/s/69JcAMmWcdmZ3XBxZk4mgQ//soplJwl25WU2TGnyt67x85rnufrWf+fx3XuY9+v1YfEfn+Z9NotreHeRn19/q/3JbblxZGUe0xTYJv4y9i0TSlRNHVt8/kiOU7Qsjvj3QReCRDCFuoGexU1yoQosflsgE0/qMgYc/el4COh6xuCmwMXvsRnHTaEP4p3H5mU0tHTq50Cm0AnxR9r3rEyhmxrT/Ck14sOm0DMrbXFh92sf2U9KMtWNIMstJ7b+7WaSAOp8JALwiW26PTXscTMkAoiJ3Ztc6XZL/SRUJ2JGA5ATu8sNUXVzMINBK+mKegoAn9jF9tqGqLp+j+GO+BokSzMAu01sbVTdALBQdAmSyz9GAG4r5+HURNUDAAzG958aAepvBjptPKpyAFgrMXiHNgYAaSudRsgRAbhrJX4jhlMLYPLWcFRVAZQBX0fwEGVWRNEAUOLV6fYggKLVBJklDkCL2ADlBUDxuJATxQDSNzVnETq1KQIgtQJcEwYwbnfNSKF6bLZ3e9UoAB9PwDljAPWOTComx32mVrkGIEk/q/Hd55IBgBBV+UwzACTv5fMmsQYwRdVU1L0BAF69MaqKIFmEABjYpI+qMt6wPghAl+iiqhok01AAeFQ9lz4BAZCoyr364SdDAkBR9ZwhBQe4RtV7hhQcQA17jIcfdWqEB5BRdYCCZAQAdbHvHiSjAMioes+QIgEsH6/69/fvRwNI2uU2n+QH8AP4AfwA/geAfIl5xUgGYINfgO5dIHUpCLCHan8Asst1z8chgCNZ0daGNgA8+QFLszuA6Eq9Ey8Acg3nmniCAMAykBPA6X5Q1+ECAKXsDgDXEgDou5wA4KLlOQBwv1sGrgAwpDHxFAApAy9UAgDvSj0D6PBC+KQLB9B0pR4BaLtc6uriDjCCM+Q5QNsYegCyNFtXehp9V8oeYK7My0HcO61/q0zbC7ADOHpc5i7XeReCbv3SDiAvZmoH81yadbqeERlAGFNL6qXXB4G+1UgHsGxdptMhQq/vsFABRCekpO2nyL/cBj6JDwDL9jUXK/MEYNnA5266+jReAI6My0J80RNoPQBYbuJIa3VFzgMA1GUhiH+I5QzwUHwhliOA5VYmoCHkBtBbbeY6i+8FwGo720V8bwDEDX0McdOuAMQtjXjP8jnAdJQvFPXzMpttakMSACtnogHC4jsDAI1rK/HdAZSlXjz5k+IjlE4A5t2EGvH9AMjqD3qEVnxPABpTYKQEzR0AKSpTqBETCEAWnHKszeJ7Bbg+0CI79wWgOltG3IDoF0AxhcImStAAaB5fjLxNdl6SAHBHhjgmYml2lFIGgN4i407Tab2lXXZeGZJp3e4ruDyn7aikl1JgLod+mQhgl03DO/AcALj/pm8BJs9tCsCz/fBjQ9rHTwCwLKXu63vava1GAJczEd1kTsIMAK6nQvR7W40Aae5+LqY2mIIOoG58HAcxvAUOYB49sinodMQAiEk81RRwS0YASDPIyhTEXO4IAGPj/ywQ5s0AAKsM6ZEpjDoAizhifUER7QqQW0RSB1OQtz8DWC5ePzGFa/GpAnSBxAfzOh7aJQC1NvJgCuo4C4CwZ6+upqBY2g4wxj2IqM61FWB6Pzl05eiduSksb54VcU4gIv5WrF/GPxbNnU5M8a+mcLTBIp7DhUwhtvjXvKuMfhb7n77+AGh46n0jpCtjAAAAAElFTkSuQmCC" alt="Logo">
</header>

<footer>
    Page <span class="pagenum"></span>
</footer>

<h2>{{ $title }}</h2>

<table>
    <thead>
    <tr>
        @foreach($data[0] as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach(array_slice($data, 1) as $row)
        <tr>
            @foreach($row as $cell)
                <td>{{ $cell }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
