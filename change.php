<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>The Dream</title>
    <style>
#main{
    background-image: url(./src/fond.jpg);
    background-repeat: no-repeat;
}
</style>
</head>

<body id="main" class="container text-center">

<h2 style="color:aliceblue">taux de change</h2>
<form method="post" style="border: 1px solid black; padding: 50px; margin-left: 400px; margin-right: 400px; border-radius:5%; background-color:gray">
    <label for="from" style=" font-size:20px;" >from</label><br>
    <select name="from" id="from" class=" border border-2 border-dark rounded btn dropdown-toggle" style="width: 350px; height:50px; font-size:20px; background-color:dimgrey">
    <option value="AUD">Dollars Australien</option>
    <option value="CAD">Dollars Canadien</option>
    <option value="CHF">Franc Suisse</option>
    <option value="CNY">Yuan</option>
    <option value="EUR">Euro</option>
    <option value="GBP">Livre Sterling</option>
    <option value="HKD">Dollars de Hong Kong</option>
    <option value="IDR">Roupie Indonésienne</option>
    <option value="INR">Roupie Indienne</option>
    <option value="JPY">Yen</option>
    <option value="KRW">Won</option>
    <option value="MXN">Peso Mexicain</option>
    <option value="NZD">Dollars Néo-Zélandais</option>
    <option value="RUB">Rouble</option>
    <option value="SGD">Dollars Singapourien</option>
    <option value="USD">Dollars Américain</option>
    <option value="ZAR">Rand</option>
    </select><br>
    <label for="to" style="font-size:20px;">to</label><br>
    <select name="to" id="to" class=" border border-2 border-dark rounded btn dropdown-toggle" style="width: 350px; height:50px; font-size:20px; background-color:dimgrey">
    <option value="GBP">Livre Sterling</option>
    <option value="HKD">Dollars de Hong Kong</option>
    <option value="IDR">Roupie Indonésienne</option>
    <option value="INR">Roupie Indienne</option>
    <option value="JPY">Yen</option>
    <option value="KRW">Won</option>
    <option value="AUD">Dollars Australien</option>
    <option value="CAD">Dollars Canadien</option>
    <option value="CHF">Franc Suisse</option>
    <option value="CNY">Yuan</option>
    <option value="EUR">Euro</option>
    <option value="MXN">Peso Mexicain</option>
    <option value="NZD">Dollars Néo-Zélandais</option>
    <option value="RUB">Rouble</option>
    <option value="SGD">Dollars Singapourien</option>
    <option value="USD">Dollars Américain</option>
    <option value="ZAR">Rand</option>
    </select><br>
    <label for="amount" style="font-size:20px;">amount</label><br>
    <input type="number" name="amount" id="amount" class="border border-2 border-dark rounded dropdown-toggle" style="width: 350px; height:50px; font-size:20px; margin-bottom: 5px;"><br>
    <input type="submit" value="convert" class=" border border-2 border-dark rounded btn dropdown-toggle" style="width: 350px; height:50px; font-size:20px; background-color:dimgrey; margin-bottom:5px;">
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['from'], $_POST['to'], $_POST['amount'])) {
        $from = $_POST['from']; // Corrected variable names
        $to = $_POST['to'];
        $amount = $_POST['amount'];
        // var_dump($from, $to, $amount);

        // Replace 'YOUR_API_KEY' with your actual API key
        $api_url = "https://v6.exchangerate-api.com/v6/240376979b38528c7b9ddc4b/latest/$from";

        // Fetch exchange rate data from the API
        $response = file_get_contents($api_url);

        // Check if the request was successful
        if ($response !== false) {
            // Decode JSON response
            $data = json_decode($response, true);

            // Check if the data was successfully decoded
            if ($data && $data['result'] == 'success') {
                // Extract exchange rate for the selected currency
                $exchange_rate = $data['conversion_rates'][$to];

                // Calculate the equivalent amount
                $result = $amount * $exchange_rate;

                // Display the result
                echo "<p>$amount $from is equal to $result $to</p>";
            } else {
                echo "<p>Error retrieving exchange rate data.</p>";
            }
        } else {
            echo "<p>Error fetching data from the API.</p>";
        }
    }
    ?>
</form>
</body>
</html>