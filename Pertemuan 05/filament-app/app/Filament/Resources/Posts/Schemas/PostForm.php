<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Main Column (Kiri) - Memakan 2/3 layar
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            // Validasi 1: Title min 5 karakter + Custom Message
                            TextInput::make("title")
                                ->required()
                                ->minLength(5)
                                ->validationMessages([
                                    'required' => 'Judul artikel wajib diisi ya!',
                                    'min' => 'Judul terlalu pendek, minimal harus 5 karakter.'
                                ]),

                            // Validasi 2: Slug unik & min 3 karakter + Custom Message
                            TextInput::make("slug")
                                ->required()
                                ->minLength(3)
                                ->unique(ignoreRecord: true) // ignoreRecord agar aman saat proses Edit
                                ->validationMessages([
                                    'required' => 'Slug tidak boleh kosong.',
                                    'unique' => 'Slug ini sudah dipakai, silakan cari variasi lain.',
                                    'min' => 'Slug minimal 3 karakter.'
                                ]),

                            // Validasi 3: Category wajib dipilih
                            Select::make("category_id")
                                ->relationship("category", "nama")
                                ->preload()
                                ->searchable()
                                ->required(), // Wajib diisi

                            ColorPicker::make("color"),
                        ])->columns(2), // Membagi field di atas menjadi 2 kolom agar rapi

                        MarkdownEditor::make("content")
                            ->columnSpanFull(), // Agar editor mengisi penuh ruang horizontal

                    ])->columnSpan(2), // Memerintahkan Section ini memakan 2 ruang grid


                // Sidebar Column (Kanan) - Memakan 1/3 layar
                Group::make([

                    // Section 2 - Image
                    Section::make("Image Upload")
                        ->schema([
                            // Validasi 4: Image wajib diupload
                            FileUpload::make("image")
                                ->disk("public")
                                ->directory("posts")
                                ->required() // Wajib diisi
                                ->validationMessages([
                                    'required' => 'Jangan lupa upload gambar sampulnya!'
                                ]),
                        ]),

                    // Section 3 - Meta
                    Section::make("Meta Information")
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                        ]),

                    DateTimePicker::make("published_at"),

                ])->columnSpan(1) // Memerintahkan Group ini memakan 1 ruang grid

            ])->columns(3); // Membagi total layout form menjadi 3 kolom
    }
}
