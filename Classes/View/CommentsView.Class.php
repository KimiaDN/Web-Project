<?php 

class CommentsView extends Comments{

    public function FetchComments($doctor_id, $limit){
        $result = $this->GetComments($doctor_id, $limit);
        return $result;
    }

    public function FetchCommentsSize($doctor_id, $limit){
        $result = $this->CommentsSize($doctor_id, $limit);
        return $result;
    }
}