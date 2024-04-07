<?php

class CategoriesModel
{
    private PDO $connection;
    public function __construct(
        private Database $database
    ) {
        $this->connection = $this->database->getConnection();
    }

    public function getCategories(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM categories');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategory(int $id): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory(array $data): array
    {
        $stmt = $this->connection->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute(['name' => $data['name']]);
        return $this->getCategory((int)$this->connection->lastInsertId());
    }

    public function updateCategory(int $id, array $data): array
    {
        $stmt = $this->connection->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $stmt->execute(['id' => $id, 'name' => $data['name']]);
        return $this->getCategory($id);
    }

    public function deleteCategory(int $id): array
    {
        $category = $this->getCategory($id);
        $stmt = $this->connection->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $category;
    }
}
