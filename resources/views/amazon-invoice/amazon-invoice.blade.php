<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Amazon Invoice</title>
    <!-- Include any CSS stylesheets or external CSS links -->
</head>
<body>
    <h2>Upload Amazon Invoice</h2>

    <div class="status-section">
        <div class="status-title">Select the invoice to upload</div>
        <form method="POST" action="{{ route('amazon.invoice') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pdfFile" class="form-label">PDF File:</label>
                <input type="file" id="pdfFile" name="pdfFile" class="form-control" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Upload Invoice" class="form-button">
            </div>
        </form>
    </div>

    <!-- Include any additional HTML content or scripts -->

</body>
</html>

