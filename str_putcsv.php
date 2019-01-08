<?php declare(strict_types=1);

if (!function_exists('str_putcsv'))
{
    function str_putcsv(array $fields, ?string $delimiter = null, ?string $enclosure = null, ?string $escape = null): string
    {
        $delimiter = $delimiter ?? ',';
        $enclosure = $enclosure ?? '"';
        $escape = $escape ?? '\\';

        // Open an in-memory file resource
        $fp = fopen('php://temp', 'r+b');

        // Write the fields array to the file resource as a CSV line
        fputcsv($fp, $fields, $delimiter, $enclosure, $escape);

        // Rewind the file resource so it can be read
        rewind($fp);

        // Read the entire CSV line
        $csv = stream_get_contents($fp);

        // Remove the trailing line feed added by fputcsv
        $csv = rtrim($csv, "\n");

        // Close the file resource
        fclose($fp);

        return $csv;
    }
}
