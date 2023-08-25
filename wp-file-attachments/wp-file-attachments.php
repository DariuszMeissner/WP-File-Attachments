<?php

/**
 * Plugin Name: WP File Attachments
 * Description: This plugin adds file attachments as custom fileds, to use: add shortcode [acf_repeater_attachment_shortcode]
 * Author: Dariusz Meissner
 * Version: 1.0
 */

function acf_repeater_attachment()
{
  ob_start(); ?>

  <?php if (have_rows('repeater_attachment')) : ?>

    <div class="attachments">
      <p class="attachments_header">
        <i class="fa-solid fa-paperclip fa-flip-vertical"></i>
        <span>Załączniki:</span>
      </p>

      <ul class="attachments_list">
        <?php while (have_rows('repeater_attachment')) : the_row();
          // vars

          $attachment_id = get_sub_field('file');
          // (thumbnail, medium, large, full or custom size)
          $size = "thumbnail";
          // Attachment URL
          $url = wp_get_attachment_url($attachment_id);
          // Get the file name
          $title = get_the_title($attachment_id);

          //file extension
          $path_info = pathinfo(get_attached_file($attachment_id));

          // filesize
          $filesize = filesize(get_attached_file($attachment_id));
          $filesize = size_format($filesize, 2);
        ?>



          <!-- links    -->
          <li class="attachments_list-item" filetype-<?php echo $path_info['extension']; ?>>
            <a class="anchor" href="<?php echo $url; ?>">
              <?php if (
                $path_info['extension'] == 'png' || $path_info['extension'] == 'jpg' || $path_info['extension'] == 'jpeg' ||
                $path_info['extension'] == 'bmp' || $path_info['extension'] == 'gif'
              ) : ?>
                <i class="icon-file-attachments">
                  <svg aria-hidden="true" class="e-font-icon-svg e-far-file-image" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm32-48h224V288l-23.5-23.5c-4.7-4.7-12.3-4.7-17 0L176 352l-39.5-39.5c-4.7-4.7-12.3-4.7-17 0L80 352v64zm48-240c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"></path>
                  </svg>
                </i>
              <?php elseif ($path_info['extension'] == 'pdf') : ?>
                <i class="icon-file-attachments">
                  <svg aria-hidden="true" class="e-font-icon-svg e-far-file-pdf" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm250.2-143.7c-12.2-12-47-8.7-64.4-6.5-17.2-10.5-28.7-25-36.8-46.3 3.9-16.1 10.1-40.6 5.4-56-4.2-26.2-37.8-23.6-42.6-5.9-4.4 16.1-.4 38.5 7 67.1-10 23.9-24.9 56-35.4 74.4-20 10.3-47 26.2-51 46.2-3.3 15.8 26 55.2 76.1-31.2 22.4-7.4 46.8-16.5 68.4-20.1 18.9 10.2 41 17 55.8 17 25.5 0 28-28.2 17.5-38.7zm-198.1 77.8c5.1-13.7 24.5-29.5 30.4-35-19 30.3-30.4 35.7-30.4 35zm81.6-190.6c7.4 0 6.7 32.1 1.8 40.8-4.4-13.9-4.3-40.8-1.8-40.8zm-24.4 136.6c9.7-16.9 18-37 24.7-54.7 8.3 15.1 18.9 27.2 30.1 35.5-20.8 4.3-38.9 13.1-54.8 19.2zm131.6-5s-5 6-37.3-7.8c35.1-2.6 40.9 5.4 37.3 7.8z"></path>
                  </svg>
                </i>
              <?php elseif ($path_info['extension'] == 'doc' || $path_info['extension'] == 'docm' || $path_info['extension'] == 'docx' || $path_info['extension'] == 'dot') : ?>
                <i class="icon-file-attachments">
                  <svg aria-hidden="true" class="e-font-icon-svg e-far-file-word" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm220.1-208c-5.7 0-10.6 4-11.7 9.5-20.6 97.7-20.4 95.4-21 103.5-.2-1.2-.4-2.6-.7-4.3-.8-5.1.3.2-23.6-99.5-1.3-5.4-6.1-9.2-11.7-9.2h-13.3c-5.5 0-10.3 3.8-11.7 9.1-24.4 99-24 96.2-24.8 103.7-.1-1.1-.2-2.5-.5-4.2-.7-5.2-14.1-73.3-19.1-99-1.1-5.6-6-9.7-11.8-9.7h-16.8c-7.8 0-13.5 7.3-11.7 14.8 8 32.6 26.7 109.5 33.2 136 1.3 5.4 6.1 9.1 11.7 9.1h25.2c5.5 0 10.3-3.7 11.6-9.1l17.9-71.4c1.5-6.2 2.5-12 3-17.3l2.9 17.3c.1.4 12.6 50.5 17.9 71.4 1.3 5.3 6.1 9.1 11.6 9.1h24.7c5.5 0 10.3-3.7 11.6-9.1 20.8-81.9 30.2-119 34.5-136 1.9-7.6-3.8-14.9-11.6-14.9h-15.8z"></path>
                  </svg>
                </i>
              <?php else : ?>
                <i class="icon-file-attachments">
                  <svg aria-hidden="true" class="e-font-icon-svg e-far-file" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48z"></path>
                  </svg>
                </i>
              <?php endif; ?>



              <span class="file-name">
                <?php echo $title; ?>
                .<?php echo $path_info['extension']; ?>
              </span>


            </a>
          </li>

        <?php endwhile; ?>

      </ul>
    </div>

  <?php endif; ?>

<?php $output = ob_get_clean();
  return $output;
}
add_shortcode('acf_repeater_attachment_shortcode', 'acf_repeater_attachment');
