<?php
// Function to simulate driver details for a taxi booking
function getDriverDetails() {
    // For demonstration, we simulate driver details
    $drivers = [
        ['name' => 'James Mwangi', 'car_plate' => 'KAA 123A', 'pickup_time' => '08:30:00'],
        ['name' => 'Alice Wanjiku', 'car_plate' => 'KBB 456B', 'pickup_time' => '09:00:00'],
        ['name' => 'Peter Otieno', 'car_plate' => 'KCC 789C', 'pickup_time' => '09:30:00']
    ];
    // Return a random driver
    return $drivers[array_rand($drivers)];
}
?>
