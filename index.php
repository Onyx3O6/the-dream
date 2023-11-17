<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>The Dream - Monetary Change</title>
</head>

<body class="container" style="background-color:antiquewhite;">
    <div class="row-md-5 text-center border-dark border-2 rounded-3 bg-primary w-25 mx-5 position-absolute top-50 start-50 translate-middle">
        <h2>taux de change</h2>
        <form method="post" class="border-top-dark border-2 bg-light">
            <label for="from"></label><br>
            <select name="from" id="from" class="btn btn-outline-primary dropdown-toggle">
                <option value="AUD">Dollars Australien (AUD)</option>
                <option value="CAD">Dollars Canadien (CAD)</option>
                <option value="CHF">Franc Suisse (CHF)</option>
                <option value="CNY">Yuan (CNY)</option>
                <option value="EUR">Euro (EUR)</option>
                <option value="GBP">Livre Sterling (GBP)</option>
                <option value="HKD">Dollars de Hong Kong (HKD)</option>
                <option value="IDR">Roupie Indonésienne (IDR)</option>
                <option value="INR">Roupie Indienne (INR)</option>
                <option value="JPY">Yen (JPY)</option>
                <option value="KRW">Won (KRW)</option>
                <option value="MXN">Peso Mexicain (MXN)</option>
                <option value="NZD">Dollars Néo-Zélandais (NZD)</option>
                <option value="RUB">Rouble (RUB)</option>
                <option value="SGD">Dollars Singapourien (SGD)</option>
                <option value="USD">Dollars Américain (USD)</option>
                <option value="ZAR">Rand (ZAR)</option>
            </select><br>
            <label for="to"></label><br>
            <select name="to" id="to" class="btn btn-outline-primary dropdown-toggle">
                <option value="GBP">Livre Sterling (GBP)</option>
                <option value="HKD">Dollars de Hong Kong (KHD)</option>
                <option value="IDR">Roupie Indonésienne (IDR)</option>
                <option value="INR">Roupie Indienne (INR)</option>
                <option value="JPY">Yen (JPY)</option>
                <option value="KRW">Won (KRW)</option>
                <option value="AUD">Dollars Australien (AUD)</option>
                <option value="CAD">Dollars Canadien (CAD)</option>
                <option value="CHF">Franc Suisse (CHF)</option>
                <option value="CNY">Yuan (CNY)</option>
                <option value="EUR">Euro (EUR)</option>
                <option value="MXN">Peso Mexicain (MXN)</option>
                <option value="NZD">Dollars Néo-Zélandais (NZD)</option>
                <option value="RUB">Rouble (RUB)</option>
                <option value="SGD">Dollars Singapourien (SGD)</option>
                <option value="USD">Dollars Américain (USD)</option>
                <option value="ZAR">Rand (ZAR)</option>
            </select><br>
            <label for="amount" style="font-size:20px;">amount</label><br>
            <input type="number" name="amount" id="amount"><br>
            <input type="submit" value="convert">
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
    </div>
</body>

</html>