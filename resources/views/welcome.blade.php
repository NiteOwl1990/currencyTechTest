<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-2xl p-6 bg-white shadow rounded" x-data="currencyDashboard()">
        <h1 class="text-2xl font-bold mb-4">Currency Exchange Rates</h1>
        <button
            @click="fetchRates"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4"
        >
            Fetch Rates
        </button>
        <template x-if="error">
            <div class="text-red-500 mb-4" x-text="error"></div>
        </template>
        <template x-if="Object.keys(rates).length > 0">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Currency</th>
                        <th class="border border-gray-300 px-4 py-2">Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(rate, currency) in rates" :key="currency">
                        <tr>
                            <td class="border border-gray-300 px-4 py-2" x-text="currency"></td>
                            <td class="border border-gray-300 px-4 py-2" x-text="rate"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </template>
    </div>
    <script>
        function currencyDashboard() {
            return {
                rates: {},
                error: null,
                async fetchRates() {
                    this.error = null;
                    try {
                        const response = await fetch('/exchange-rates');
                        const data = await response.json();
                        if (response.ok) {
                            this.rates = data.rates;
                        } else {
                            this.error = data.error || 'Failed to fetch data.';
                        }
                    } catch (err) {
                        this.error = 'An error occurred while fetching data.';
                    }
                }
            };
        }
    </script>
</body>
</html>
