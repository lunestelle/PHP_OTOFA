<?php

class Document
{
    use Model;

    protected $table = 'documents';
    protected $allowedColumns = [
        'tricycle_id',
        'document_type',
        'filename',
        'file_path',
    ];
    protected $order_column = 'document_id';

    public function setDocumentType($file)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
            case 'png':
                return 'Image';
            case 'pdf':
                return 'PDF';
            case 'doc':
            case 'docx':
                return 'Word document';
            case 'xls':
            case 'xlsx':
                return 'Excel document';
            default:
                return 'Unknown';
        }
    }
}