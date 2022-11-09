
<?php

class diplay
{
    private $each;
    public function __construct($each)
    {
        $this->each = $each;
    }
    public function show_name()
    {


        if (array_key_exists('level', $this->each)) {
            echo "admin: " . $this->each['name'];
        } else {
            echo "Người dùng: " . $this->each['name'];
        }
    }
    public function show_time()
    {
        echo "thời gian ";
        if (!empty($this->each['rating']) && !empty($this->each['comment'])) {
            echo "đánh giá và bình luận: ";
        } else if (!empty($this->each['rating'])) {
            echo "đánh giá: ";
        } else {
            echo "bình luận: ";
        }
        echo $this->each['create_at'];
    }
    public function show_rating()
    {
        echo empty($this->each['rating']) ? "" : "rating: " . $this->each['rating'];
    }
    public function show_comment()
    {
        echo empty($this->each['comment']) ? "" : "comment: " . $this->each['comment'];
    }
}
