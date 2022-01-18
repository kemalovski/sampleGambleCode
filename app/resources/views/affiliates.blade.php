<!DOCTYPE html>
<html>
   <head>
      <style>
         table {
         font-family: arial, sans-serif;
         border-collapse: collapse;
         width: 100%;
         }
         td, th {
         border: 1px solid #dddddd;
         text-align: left;
         padding: 8px;
         }
         tr:nth-child(even) {
         background-color: #dddddd;
         }
      </style>
   </head>
   <body>
      <h2>Affiliates within 100 Km</h2>
      <table>
         <tr>
            <th>Affiliate Id</th>
            <th>Name</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Distance</th>
         </tr>
         @foreach ($affiliates as $affiliate)
             <tr>
                <th>{{ $affiliate["affiliate_id"] }}</th>
                <th>{{ $affiliate["name"] }}</th>
                <th>{{ $affiliate["latitude"] }}</th>
                <th>{{ $affiliate["longitude"] }}</th>
                <th>{{ $affiliate["distanceFromDublinOffice"] }}</th>
            </tr>
        @endforeach
      </table>
   </body>
</html>