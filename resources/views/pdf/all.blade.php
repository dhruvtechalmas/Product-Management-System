<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>

    <style>
        body {
            font-family: DejaVu Sans;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="logo">
    <h2>PMS Company</h2>
</div>

<h3>All Products Report</h3>

<p>Date: {{ now() }}</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Category</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->sku }}</td>
            <td>{{ $p->category->name ?? '-' }}</td>
            <td>₹{{ $p->price }}</td>
            <td>{{ $p->quantity }}</td>
            <td>
                {{ $p->status ? 'Active' : 'Inactive' }}
            </td>
            <td>{{ $p->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>