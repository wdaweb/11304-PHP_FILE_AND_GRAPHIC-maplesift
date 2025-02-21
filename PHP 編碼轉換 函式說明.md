# PHP `mb_convert_encoding()` 函式說明

## **函式語法**
```php
mb_convert_encoding( string $str , string $to_encoding , string|array $from_encoding )
```

## **參數說明**
1. **`$str`（第一個參數）**  
   - 需要轉換的字串，通常是從檔案或資料庫讀取的內容。

2. **`$to_encoding`（第二個參數）**  
   - 目標編碼，也就是你希望轉換成的編碼，例如 `UTF-8`。

3. **`$from_encoding`（第三個參數）**  
   - 原始字串的編碼，也就是目前檔案的編碼，例如 `SJIS`（Shift-JIS）。
   - 這個參數可以是 **單一編碼** 或 **編碼陣列**。

---

## **範例**
### **基本用法：Shift-JIS 轉換成 UTF-8**
如果你的 CSV 檔案是 Shift-JIS，而你的網頁是 UTF-8，正確的轉換方式：
```php
$line = mb_convert_encoding($line, 'UTF-8', 'SJIS');
```
這樣 `$line` 會從 **Shift-JIS** 轉成 **UTF-8**，然後在網頁上正常顯示。

---

### **支援多種來源編碼**
如果不確定 CSV 的原始編碼，你可以提供多種編碼選項，讓 `mb_convert_encoding()` 自動判斷：
```php
$line = mb_convert_encoding($line, 'UTF-8', ['SJIS', 'EUC-JP', 'ISO-8859-1', 'ASCII']);
```
這樣 PHP 會嘗試從 `SJIS`、`EUC-JP`、`ISO-8859-1` 和 `ASCII` 中選擇正確的來源編碼。

---

## **如何檢測檔案的編碼？**
如果你不確定 CSV 檔案的編碼，可以用 `mb_detect_encoding()` 來檢查：
```php
$file_path = "你的檔案.csv";
$content = file_get_contents($file_path);
$encoding = mb_detect_encoding($content, ['UTF-8', 'SJIS', 'EUC-JP', 'ISO-8859-1', 'BIG5'], true);
echo "檔案編碼：$encoding";
```
這樣你就可以知道應該用哪種 `$from_encoding` 來轉換。

---

## **確保 HTML 頁面顯示正確編碼**
如果你希望 PHP 轉換後的內容正常顯示在網頁上，請確保：
- **PHP 設定 UTF-8 輸出**
  ```php
  header("Content-Type: text/html; charset=UTF-8");
  ```
- **HTML 文件設定 UTF-8**
  ```html
  <meta charset="UTF-8">
  ```

這樣可以確保 `Shift-JIS` 轉換為 `UTF-8` 後，瀏覽器可以正確顯示中文字。

---

## **總結**
- `mb_convert_encoding()` 用於 **字串編碼轉換**。
- 轉換時應 **確認原始編碼**，再設定 `$from_encoding`。
- 使用 `mb_detect_encoding()` 可檢查檔案原始編碼。
- 避免亂碼，請確保 **PHP 輸出 UTF-8 並在 HTML 設定 UTF-8**。

這樣你的 CSV 內容無論是 `Shift-JIS` 或 `UTF-8`，都可以正確顯示！🚀

