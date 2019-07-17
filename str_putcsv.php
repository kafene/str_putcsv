<?php declare(strict_types=1);

if (!function_exists('str_putcsv'))
{
    /**
     * Convert an array into a CSV string.
     *
     * @param array $fields
     * The array to convert.
     * @param string $delimiter [optional]
     * Set the field delimiter (one character only).
     * Defaults to a comma (,)
     * @param string $enclosure [optional]
     * Set the field enclosure character (one character only).
     * Defaults to a double quote (")
     * @param string $escape [optional]
     * Set the escape character (one character only). 
     * Defaults to a backslash (\)
     * @return string The CSV string containing all the data.
     */
    function str_putcsv(array $fields, ?string $delimiter = ',', ?string $enclosure = '"', ?string $escape = '\\'): string
    {
        // Open an in-memory file resource
        $fp = fopen('php://temp', 'r+b');

        try {
            // Write the fields array to the file resource as a CSV line
            fputcsv($fp, $fields, $delimiter, $enclosure, $escape);

            // Rewind the file resource so it can be read
            rewind($fp);

            // Read the entire CSV line
            $csv = stream_get_contents($fp);

            // Remove the trailing line feed added by fputcsv
            $csv = rtrim($csv, "\n");
        } finally {
            // Close the file resource
            if (is_resource($fp)) {
                fclose($fp);
            }
        }

        return $csv;
    }
}
