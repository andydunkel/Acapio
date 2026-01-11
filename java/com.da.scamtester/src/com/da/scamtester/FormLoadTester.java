package com.da.scamtester;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Random;

public class FormLoadTester {
    
    // Konfiguration
    private static final String SUBMIT_URL = "https://fibbanc.com/fib/submit.php";
    private static final int TOTAL_REQUESTS = 100;
    private static final int DELAY_BETWEEN_REQUESTS_MS = 100; // Pause zwischen Anfragen
    
    private static final Random random = new Random();
    private static final String[] FIRST_NAMES = {"Max", "Anna", "Peter", "Lisa", "Thomas", "Julia", "Michael", "Sarah"};
    private static final String[] LAST_NAMES = {"Müller", "Schmidt", "Schneider", "Fischer", "Weber", "Meyer", "Wagner", "Becker"};
    private static final String[] CITIES = {"Berlin", "München", "Hamburg", "Köln", "Frankfurt", "Stuttgart", "Düsseldorf", "Dortmund"};
    private static final String[] STREETS = {"Hauptstraße", "Bahnhofstraße", "Kirchweg", "Gartenstraße", "Schulstraße"};
    private static final String[] GENDERS = {"Male", "Female", "Other"};
    private static final String[] EMPLOYMENT_STATUS = {"Full-time", "Part-time", "Self-employed", "Unemployed"};
    
    public static void main(String[] args) {
        System.out.println("=== Form Load Tester ===");
        System.out.println("URL: " + SUBMIT_URL);
        System.out.println("Requests: " + TOTAL_REQUESTS);
        System.out.println("Delay: " + DELAY_BETWEEN_REQUESTS_MS + "ms");
        System.out.println("========================\n");
        
        int successCount = 0;
        int errorCount = 0;
        long totalTime = 0;
        
        long startTime = System.currentTimeMillis();
        
        for (int i = 1; i <= TOTAL_REQUESTS; i++) {
            try {
                long requestStart = System.currentTimeMillis();
                int statusCode = sendFormRequest();
                long requestTime = System.currentTimeMillis() - requestStart;
                totalTime += requestTime;
                
                if (statusCode >= 200 && statusCode < 300) {
                    successCount++;
                    System.out.printf("[%d/%d] SUCCESS - %dms (Status: %d)%n", 
                        i, TOTAL_REQUESTS, requestTime, statusCode);
                } else {
                    errorCount++;
                    System.out.printf("[%d/%d] ERROR - %dms (Status: %d)%n", 
                        i, TOTAL_REQUESTS, requestTime, statusCode);
                }
                
                // Pause zwischen Anfragen
                if (i < TOTAL_REQUESTS && DELAY_BETWEEN_REQUESTS_MS > 0) {
                    Thread.sleep(DELAY_BETWEEN_REQUESTS_MS);
                }
                
            } catch (Exception e) {
                errorCount++;
                System.out.printf("[%d/%d] EXCEPTION: %s%n", i, TOTAL_REQUESTS, e.getMessage());
            }
        }
        
        long totalDuration = System.currentTimeMillis() - startTime;
        
        // Statistiken ausgeben
        System.out.println("\n=== Results ===");
        System.out.println("Total requests: " + TOTAL_REQUESTS);
        System.out.println("Successful: " + successCount);
        System.out.println("Errors: " + errorCount);
        System.out.println("Success rate: " + String.format("%.2f%%", (successCount * 100.0 / TOTAL_REQUESTS)));
        System.out.println("Total time: " + totalDuration + "ms");
        System.out.println("Average response time: " + (totalTime / TOTAL_REQUESTS) + "ms");
        System.out.println("Requests per second: " + String.format("%.2f", (TOTAL_REQUESTS * 1000.0 / totalDuration)));
    }
    
    private static int sendFormRequest() throws Exception {
        URL url = new URL(SUBMIT_URL);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("POST");
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
        conn.setDoOutput(true);
        conn.setConnectTimeout(5000);
        conn.setReadTimeout(5000);
        
        String postData = generateFormData();
        
        try (OutputStream os = conn.getOutputStream()) {
            byte[] input = postData.getBytes(StandardCharsets.UTF_8);
            os.write(input, 0, input.length);
        }
        
        int responseCode = conn.getResponseCode();
        
        // Response Body lesen
        try (java.io.BufferedReader br = new java.io.BufferedReader(
                new java.io.InputStreamReader(conn.getInputStream(), StandardCharsets.UTF_8))) {
            StringBuilder response = new StringBuilder();
            String responseLine;
            while ((responseLine = br.readLine()) != null) {
                response.append(responseLine.trim());
            }
            System.out.println("    Response: " + response.toString());
        } catch (Exception e) {
            System.out.println("    Response read error: " + e.getMessage());
        }
        
        conn.disconnect();
        
        return responseCode;
    }
    
    private static String generateFormData() throws Exception {
        String firstName = FIRST_NAMES[random.nextInt(FIRST_NAMES.length)];
        String lastName = LAST_NAMES[random.nextInt(LAST_NAMES.length)];
        String email = firstName.toLowerCase() + "." + lastName.toLowerCase() + random.nextInt(1000) + "@example.com";
        String dob = generateRandomDate();
        String gender = GENDERS[random.nextInt(GENDERS.length)];
        String password = "Pass" + random.nextInt(10000);
        String phone = "+49" + (random.nextInt(900000000) + 100000000);
        String street = STREETS[random.nextInt(STREETS.length)];
        String streetNumber = String.valueOf(random.nextInt(100) + 1);
        String city = CITIES[random.nextInt(CITIES.length)];
        String postcode = String.valueOf(10000 + random.nextInt(90000));
        String occupation = "Softwareentwickler";
        String employer = "Firma " + random.nextInt(100);
        String salary = String.valueOf(30000 + random.nextInt(70000));
        String employmentStatus = EMPLOYMENT_STATUS[random.nextInt(EMPLOYMENT_STATUS.length)];
        
        StringBuilder data = new StringBuilder();
        data.append("first_name=").append(encode(firstName));
        data.append("&last_name=").append(encode(lastName));
        data.append("&dob=").append(encode(dob));
        data.append("&gender=").append(encode(gender));
        data.append("&email=").append(encode(email));
        data.append("&password=").append(encode(password));
        data.append("&phone=").append(encode(phone));
        data.append("&address_line1=").append(encode(street + " " + streetNumber));
        data.append("&address_line2=").append("");
        data.append("&city=").append(encode(city));
        data.append("&state_region=").append(encode(city));
        data.append("&postcode=").append(encode(postcode));
        data.append("&country=").append(encode("Germany"));
        data.append("&occupation=").append(encode(occupation));
        data.append("&employer=").append(encode(employer));
        data.append("&salary_eur=").append(encode(salary));
        data.append("&employment_status=").append(encode(employmentStatus));
        data.append("&notes=").append(encode("Automatisch generiert durch LoadTester"));
        
        return data.toString();
    }
    
    private static String generateRandomDate() {
        int year = 1950 + random.nextInt(56); // 1950-2005
        int month = 1 + random.nextInt(12);
        int day = 1 + random.nextInt(28);
        LocalDate date = LocalDate.of(year, month, day);
        return date.format(DateTimeFormatter.ISO_LOCAL_DATE);
    }
    
    private static String encode(String value) throws Exception {
        return URLEncoder.encode(value, StandardCharsets.UTF_8.toString());
    }
}