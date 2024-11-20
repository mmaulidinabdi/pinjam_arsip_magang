    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('transaksi_peminjamans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('peminjam_id')->constrained('peminjams')->onDelete('cascade');
                $table->date('tanggal_peminjaman');
                $table->string('tujuan_peminjam');
                $table->string('dokumen_pendukung')->nullable();
                $table->string('status')->default('diperiksa');
                $table->string('no_arsip')->nullable();
                $table->string('nama_arsip');
                $table->string('data_arsip')->nullable();
                $table->enum('jenis_arsip', ['SK', 'arsip2', 'IMB'])->notNull();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('transaksi_peminjamans');
        }
    };
