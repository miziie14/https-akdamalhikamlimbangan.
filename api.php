<?php
// api.php
header("Content-Type: application/json");
require 'koneksi.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'get':
        $result = $conn->query("SELECT * FROM peserta_dakwah");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            // Konversi tipe data string dari MySQL menjadi integer untuk poin
            $row['artikulasi'] = (int)$row['artikulasi'];
            $row['materi'] = (int)$row['materi'];
            $row['panggung'] = (int)$row['panggung'];
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case 'add':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("INSERT INTO peserta_dakwah (name, category, artikulasi, materi, panggung) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $data['name'], $data['category'], $data['artikulasi'], $data['materi'], $data['panggung']);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "id" => $conn->insert_id]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        $stmt->close();
        break;

    case 'update':
        $data = json_decode(file_get_contents("php://input"), true);

        // ============================================================
        // PARTIAL UPDATE: hanya update kolom yang dikirim
        // Mencegah race-condition antar juri
        // Contoh: {id: 5, artikulasi: 90} → hanya kolom artikulasi yg diupdate
        // ============================================================
        $allowedColumns = ['artikulasi', 'materi', 'panggung'];
        $updates = [];
        $params = [];
        $types = '';

        foreach ($allowedColumns as $col) {
            if (isset($data[$col])) {
                $updates[] = "$col = ?";
                $params[] = (int)$data[$col];
                $types .= 'i';
            }
        }

        if (empty($updates)) {
            echo json_encode(["status" => "error", "message" => "Tidak ada kolom yang dikirim untuk diupdate"]);
            break;
        }

        if (!isset($data['id'])) {
            echo json_encode(["status" => "error", "message" => "ID peserta tidak ditemukan"]);
            break;
        }

        $params[] = (int)$data['id'];
        $types .= 'i';

        $sql = "UPDATE peserta_dakwah SET " . implode(', ', $updates) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "updated" => $updates]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        $stmt->close();
        break;

    case 'delete':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("DELETE FROM peserta_dakwah WHERE id = ?");
        $stmt->bind_param("i", $data['id']);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        $stmt->close();
        break;

    case 'reset':
        if ($conn->query("TRUNCATE TABLE peserta_dakwah")) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Action tidak dikenal"]);
        break;
}

$conn->close();
?>