<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function allWithCategory()
    {
        $stmt = $this->db->query("
            SELECT p.*, c.name as category_name 
            FROM {$this->table} p 
            LEFT JOIN post_categories c ON p.category_id = c.id
            WHERE p.deleted_at IS NULL
            ORDER BY p.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    public function getPublished($limit = 10)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM {$this->table} p 
            LEFT JOIN post_categories c ON p.category_id = c.id
            WHERE p.status = 'published' AND p.deleted_at IS NULL
            ORDER BY p.published_at DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findBySlug($slug)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM {$this->table} p 
            LEFT JOIN post_categories c ON p.category_id = c.id
            WHERE p.slug = :slug AND p.deleted_at IS NULL
        ");
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} 
                (title, slug, short_description, content, cover_image, category_id, status, user_id, published_at) 
                VALUES (:title, :slug, :short_description, :content, :cover_image, :category_id, :status, :user_id, :published_at)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $data['id'] = $id;
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
