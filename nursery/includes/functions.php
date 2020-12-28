<?php

    require_once('db.php');

    /* formart arrays */
    function formatCode($arr) {
        echo '<pre>';
        print_r ($arr);
        echo '</prev>';
    }

    /* Select statement */
    function selectALl(){
        global $conn;
        $data = array();
        $stmt = $conn->prepare('SELECT * FROM `presult` WHERE st_id = st_id');
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows === 0) echo ('No rows');

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        $stmt->close();
        return $data;
    }

    /* Single statement */
    function selectSingle($st_name = NULL) {
        global $conn;
        $stmt = $conn->prepare('SELECT student.st_id,student.st_name,student.st_gender,student.class_name,subjects.subject_id,subjects.subject_name,subjects.first_test,subjects.second_test,subjects.assessment,subjects.exam FROM student INNER JOIN subjects ON student.st_id = subjects.st_id ORDER BY student.st_id WHERE st_id = ?');
        $stmt ->bind_param('s', $section_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) echo ('No rows');
        $row = $result->fetch_assoc();
        return $row;
    }

    /*Insert statement */
    function insert($section_name = NULL){
        global $conn;

        $stmt = $conn->prepare('INSERT INTO section (section_name) 
        VALUES (?)');
        $stmt->bind_param('s', $section_name);
        $stmt->execute();
        $stmt->close();
        header('Location: update_result.php?section_id='.$conn->insert_id);
    }

    /*Update statement */
    function update($section_name = NULL, $section_id){
        global $conn;

        $stmt = $conn->prepare('UPDATE section SET section_name = ? WHERE section_id = ?');
        $stmt->bind_param('si', $section_name, $section_id);
        $stmt->execute();
        if($stmt->affected_rows === 0) echo ('No rows updated');
        $stmt->close();
    }

    /*Delete statement */
    function delete($score_id){
        global $conn;

        $stmt = $conn->prepare('DELETE FROM section WHERE section_id = ?');
        $stmt->bind_param('i', $section_id);
        $stmt->execute();
        $stmt->close();
        header('Location:/');
    }
?>