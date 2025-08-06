<!-- In <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
  --primary-color: #5b2333;
  --primary-light: #7a3a4d;
  --primary-dark: #3d1622;
  --bg-color: #f9f9f9;
  --chat-bg: #ffffff;
  --sidebar-bg: #ffffff;
  --text-color: #333333;
  --text-light: #666666;
  --border-color: #e0e0e0;
  --sent-bubble: #5b2333;
  --received-bubble: #f0f0f0;
  --hover-bg: #f5f5f5;
}

* {
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

.app-banner1,
.app-banner2 {
  display: none !important;
}


.mobile-footer {
  display: none !important;
}

body {
  height: 100vh;
  background-color: var(--bg-color);
  margin: 0;
  color: var(--text-color);
}

.main-content {
  height: 0;
}

.chat-container {
  width: 100%;
  height: 83vh;
  border-radius: 0;
  box-shadow: none;
  overflow: hidden;
  display: flex;
  background: var(--chat-bg);
  border: none;
}

.users-list {
  width: 320px;
  border-right: 1px solid var(--border-color);
  padding: 16px;
  background: var(--sidebar-bg);
  display: flex;
  flex-direction: column;
  height: 100vh;
  overflow-y: auto;
}

.users-list h3 {
  margin: 0 0 16px 0;
  font-size: 18px;
  font-weight: 600;
  color: var(--primary-color);
}

.user {
  display: flex;
  align-items: center;
  padding: 12px;
  cursor: pointer;
  border-radius: 8px;
  transition: all 0.2s ease;
  margin-bottom: 4px;
  text-decoration: none;
  color: var(--text-color);
}

.user:hover {
  background: var(--hover-bg);
}

.user img {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  margin-right: 12px;
  object-fit: cover;
}

.user span {
  font-weight: 500;
  font-size: 15px;
}

.chat-header {
  padding: 16px;
  background: var(--chat-bg);
  border-bottom: 1px solid var(--border-color);
  display: flex;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 10;
}

.back-btn {
  display: none;
  background: none;
  border: none;
  font-size: 18px;
  margin-right: 10px;
  cursor: pointer;
  color: var(--primary-color);
}

.chat-box {
  width: 100%;
  display: flex;
  flex-direction: column;
  height: 83vh;
  background-color: var(--chat-bg);
}

.chat-body {
  flex: 1;
  padding: 16px;
  overflow-y: auto;
  background: url(<?= base_url('assets/avator/chat-bg.jpg') ?>);
  background-repeat: no-repeat;
  background-size: cover;
  background-color: #e5ddd5;
  background-blend-mode: overlay;
}

.chat-footer {
  padding: 12px;
  background: var(--chat-bg);
  border-top: 1px solid var(--border-color);
  position: sticky;
  bottom: 0;
}

.chat-footer form {
  display: flex;
  align-items: center;
  width: 100%;
  gap: 8px;
}

.message {
  max-width: 70%;
  padding: 12px 16px;
  border-radius: 18px;
  font-size: 15px;
  margin-bottom: 12px;
  line-height: 1.4;
  position: relative;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.sent {
  background-color: var(--sent-bubble);
  color: white;
  margin-left: auto;
  border-bottom-right-radius: 4px;
}

.received {
  background-color: var(--received-bubble);
  color: var(--text-color);
  margin-right: auto;
  border-bottom-left-radius: 4px;
}

.time {
  font-size: 11px;
  display: block;
  text-align: right;
  margin-top: 4px;
  opacity: 0.8;
}

.sent .time {
  color: rgba(255,255,255,0.7);
}

.received .time {
  color: var(--text-light);
}

.card-img {
  height: 100px;
  width: 100px;
  overflow: hidden;
  border-radius: 8px;
}

.card-img img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}

/* Search and active states */
#searchUser {
  width: 100%;
  padding: 10px 16px;
  border: 1px solid var(--border-color);
  border-radius: 20px;
  margin-bottom: 16px;
  font-size: 14px;
  background: var(--chat-bg);
  transition: all 0.2s ease;
}

#searchUser:focus {
  outline: none;
  border-color: var(--primary-light);
  box-shadow: 0 0 0 2px rgba(91, 35, 51, 0.1);
}

.active-user {
  background: rgba(91, 35, 51, 0.1) !important;
}

.active-user span {
  color: var(--primary-color) !important;
  font-weight: 600;
}

/* Message input area */
#message-input {
  flex: 1;
  padding: 12px 16px;
  border: 1px solid var(--border-color);
  border-radius: 24px;
  outline: none;
  font-size: 15px;
  background: var(--chat-bg);
  transition: all 0.2s ease;
}

#message-input:focus {
  border-color: var(--primary-light);
  box-shadow: 0 0 0 2px rgba(91, 35, 51, 0.1);
}

#message-input::placeholder {
  color: var(--text-light);
}

#send-btn {
  background-color: var(--primary-color);
  color: white;
  border: none;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.2s ease;
}

#send-btn:hover {
  background-color: var(--primary-dark);
}

/* Attachment styles */
.file-input-icon {
  color: var(--text-light);
  cursor: pointer;
  transition: color 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: 50%;
}

.file-input-icon:hover {
  color: var(--primary-color);
  background: rgba(91, 35, 51, 0.1);
}

.image-preview-container {
  position: relative;
  display: none;
  margin-right: 8px;
}

.image-preview {
  height: 44px;
  width: 44px;
  border-radius: 8px;
  object-fit: cover;
}

.remove-preview {
  position: absolute;
  top: -6px;
  right: -6px;
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 12px;
  line-height: 1;
  padding: 0;
}

/* Section headers */
.text-muted {
  color: var(--text-light) !important;
  font-size: 13px;
  font-weight: 500;
  margin: 16px 0 8px 0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Scrollbar styling */
.chat-body::-webkit-scrollbar {
  width: 6px;
}

.chat-body::-webkit-scrollbar-track {
  background: rgba(0,0,0,0.05);
}

.chat-body::-webkit-scrollbar-thumb {
  background: rgba(0,0,0,0.2);
  border-radius: 3px;
}

.chat-body::-webkit-scrollbar-thumb:hover {
  background: rgba(0,0,0,0.3);
}

/* Responsive */
@media (max-width: 768px) {
  body {
    background-color: var(--chat-bg) !important;
  }

  .chat-container {
    width: 100%;
    height: 100vh;
    flex-direction: column;
  }

  .users-list {
    width: 100%;
    height: auto;
    display: block;
    border-right: none;
  }

  .chat-box {
    width: 100%;
    display: none;
    height: calc(100vh - 60px);
  }

  .back-btn {
    display: inline-block;
  }

  .chat-box.active {
    display: flex;
  }

  .users-list.active {
    display: flex;
  }

  /* Show only the relevant part based on URL */
  <?php if (isset($_GET['chat']) && $_GET['chat'] != '') { ?>
    .users-list {
      display: none !important;
    }
    .chat-box {
      display: flex !important;
    }
  <?php } else { ?>
    .users-list {
      display: flex !important;
    }
    .chat-box {
      display: none !important;
    }
  <?php } ?>
}

/* Empty state for chat */
.empty-chat-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  text-align: center;
  padding: 20px;
  color: var(--text-light);
}

.empty-chat-state .material-icons {
  font-size: 48px;
  margin-bottom: 16px;
  color: var(--primary-light);
}

.empty-chat-state h4 {
  margin-bottom: 8px;
  color: var(--primary-color);
}

.empty-chat-state p {
  max-width: 300px;
}
</style>

<div class="py-md-4 py-0">
	<div class="container-fluid p-0">
		<div class="row position-relative m-0">
			<!-- Main Content -->
			<main class="col-12 mb-5 m-0 p-0">
				<div class="main-content">
					<div class="chat-container">

						<!-- USERS LIST (LEFT PANEL) -->
						<div class="users-list" id="users-list">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3>Messages</h3>
                                <a href="<?= base_url('home') ?>" class="d-sm-block d-none text-decoration-none material-icons" style="color: var(--primary-color);">home</a>
                            </div>
                        
                            <input type="text" class="form-control mb-3" id="searchUser" onkeyup="filterUsers()" placeholder="Search users...">
                        
                            <div id="no-users-found" style="display:none; color: var(--text-light); text-align:center; margin-top:16px; font-size:14px;">
                                No users found
                            </div>
                        
                            <?php
                            $yid = $profile_data['mid'];
                            $columnCheckQuery = $this->db->query("SELECT * FROM information_schema.columns WHERE table_name = 'x_chat' AND column_name = 'chat_uniq_id'");
                            if ($columnCheckQuery->num_rows() > 0) {
                                $getChatNames = $this->db->query("SELECT * FROM x_chat JOIN yn_site_mem ON (chat_sender_id = mid OR chat_receiver_id = mid) WHERE (chat_sender_id = '$yid' OR chat_receiver_id = '$yid') AND chat_uniq_id IS NOT NULL GROUP BY chat_uniq_id ORDER BY chat_created_at DESC LIMIT 50");
                            } else {
                                $getChatNames = $this->db->query("SELECT * FROM x_chat JOIN yn_site_mem ON (chat_sender_id = mid OR chat_receiver_id = mid) WHERE (chat_sender_id = '$yid' OR chat_receiver_id = '$yid') GROUP BY chat_group_by ORDER BY chat_created_at DESC LIMIT 50");
                            }
                            $followings = $this->db->query("SELECT f_follow_to FROM x_followers WHERE f_follow_by = '$yid'")->result_array();
                            $followingIds = array_column($followings, 'f_follow_to');
                        
                            echo "<h6 class='text-muted'>Active Chats</h6>";
                        
                            $chatUserIds = []; // To track active chat users
                        
                            if ($getChatNames->num_rows() > 0) {
                                foreach ($getChatNames->result_array() as $chatUsers) {
                                    if ($yid == $chatUsers['chat_sender_id']) {
                                        $userId = $chatUsers['chat_receiver_id'];
                                    } else {
                                        $userId = $chatUsers['chat_sender_id'];
                                    }
                        
                                    $chatUserIds[] = $userId;
                        
                                    $userDetails = $this->ynaps_model->getprofile_data('*', $userId);
                                    $name = $userDetails['name'];
                                    $photo = ($userDetails['photo'] != '')
                                        ? base_url('assets/mem/' . $userId . '/img/' . $userDetails['photo'])
                                        : base_url('assets/avator/noimage.png');
                                    ?>
                        
                                    <a href="<?= base_url('message?chat=' . $chatUsers['chat_uniq_id'] . '&user=' . $userId) ?>"
                                       class="user <?= (@$_GET['user'] == $userId && $chatUsers['chat_uniq_id'] == @$_GET['chat']) ? 'active-user' : '' ?>"
                                       data-id="<?= $userId ?>"
                                       data-name="<?= get_user_name($userId) ?>">
                                        <img src="<?= $photo ?>" alt="<?= $name ?>">
                                        <span><?= $name ?></span>
                                    </a>
                        
                                <?php }
                            } else {
                                echo "<p class='text-muted' style='font-size:14px;'>No active chats</p>";
                            }
                        
                            echo "<h6 class='text-muted'>Followed Users</h6>";
                        
                            if (!empty($followingIds)) {
                                foreach ($followingIds as $fid) {
                                    // Skip if already shown in active chats
                                    if (in_array($fid, $chatUserIds)) continue;
                        
                                    $userDetails = $this->ynaps_model->getprofile_data('*', $fid);
                                    $name = $userDetails['name'];
                                    $photo = ($userDetails['photo'] != '')
                                        ? base_url('assets/mem/' . $fid . '/img/' . $userDetails['photo'])
                                        : base_url('assets/avator/noimage.png');
                                    ?>
                        
                                    <a href="<?= base_url('message?chat='.rand(0000,99999).'&user=' . $fid) ?>"
                                       class="user"
                                       data-id="<?= $fid ?>"
                                       data-name="<?= get_user_name($fid) ?>">
                                        <img src="<?= $photo ?>" alt="<?= $name ?>">
                                        <span><?= $name ?></span>
                                    </a>
                        
                                <?php }
                            } else {
                                echo "<p class='text-muted' style='font-size:14px;'>You are not following anyone</p>";
                            }
                            ?>
                        </div>
                        
                        <script>
                        function filterUsers() {
                            let input = document.getElementById("searchUser").value.toLowerCase();
                            let users = document.querySelectorAll("#users-list .user");
                            let noUsers = document.getElementById("no-users-found");
                            let found = false;
                        
                            users.forEach(user => {
                                let name = user.getAttribute("data-name").toLowerCase();
                        
                                if (name.includes(input)) {
                                    user.style.display = "flex";
                                    found = true;
                                } else {
                                    user.style.display = "none";
                                }
                            });
                        
                            noUsers.style.display = found ? "none" : "block";
                        }
                        </script>


						<!-- CHAT WINDOW (RIGHT PANEL) -->
						<div class="chat-box" id="chat-box">
							<!-- Chat Header -->
							<div class="chat-header" id="chat-box-header">
								<a class="d-flex align-items-center gap-2 text-decoration-none" href="<?= base_url('message') ?>" style="color: var(--primary-color);">
									<span class="material-icons">arrow_back</span>
									<span class="fs-6">Back to chats</span>
								</a>
							</div>

							<!-- Chat Body -->
							<div class="chat-body" id="chat-body">
								<div id="chat-msg-container" class="d-flex flex-column">
									<?php
									$chat_uniq_id = $this->input->get('chat', true) ?? '';
									if ($chat_uniq_id != '') {
										$getMessages = $this->db->query("SELECT x_chat.*, p.p_title, p.p_name, p.p_cover FROM x_chat LEFT JOIN yn_ecom_products p ON x_chat.chat_product_id = p.p_id WHERE x_chat.chat_uniq_id = ? ORDER BY x_chat.chat_id ASC", [$chat_uniq_id]);

										$product = $getMessages->row_array();
										if (!empty($product['p_title'])) {
											$product_slug = base_url('product/' . $product['p_title']);
											$product_name = $product['p_name'];
											$product_image = base_url('assets/avator/upload/' . $product['p_cover']); ?>

											<div class="p-3 bg-white rounded-lg shadow-sm mb-3" style="max-width: fit-content; margin: 0 auto;">
												<div class="d-flex align-items-center gap-3">
													<div class="card-img">
														<img class="card-img-top" src="<?= $product_image ?>" alt="<?= $product_name ?>">
													</div>
													<a href="<?= $product_slug ?>" class="text-decoration-none">
														<div>
															<strong class="card-title" style="color: var(--primary-color);"><?= $product_name ?></strong>
														</div>
													</a>
												</div>
											</div>
										<?php } ?>

										<?php foreach ($getMessages->result_array() as $chat) {
											$is_sender = ($_SESSION['yid'] ?? '') == $chat['chat_sender_id'];
											$divClass = $is_sender ? "sent" : "received";
											$timeClass = $is_sender ? "text-white" : "text-muted"; ?>

											<div class="message <?= $divClass ?>">
												<p><?= htmlspecialchars($chat['chat_msg'], ENT_QUOTES, 'UTF-8') ?></p>

												<?php if ($chat['chat_attachment']) { ?>
													<a data-fancybox="chat-attachments"
														href="<?= base_url('assets/avator/upload/' . $chat['chat_attachment']) ?>"
														class="noload mb-2"
														style="display: block; border-radius: 12px; overflow: hidden;">
														<img src="<?= base_url('assets/avator/upload/' . $chat['chat_attachment']) ?>"
															style="max-width: 300px; max-height: 300px; object-fit: cover; display: block;">
													</a>
												<?php } ?>

												<small class="time"><?= date_format_1($chat['chat_created_at'], 't') ?></small>
											</div>
										<?php } ?>
									<?php } else { ?>
										<!-- Empty state when no chat is selected -->
										<div class="empty-chat-state">
											<span class="material-icons">forum</span>
											<h4>No conversation selected</h4>
											<p>Select a chat from the list to start messaging</p>
										</div>
									<?php } ?>

									<div class="prog_ups col-12 round1 mt-1 mx-0 px-0">
										<div id="progress_value_image" style="background: var(--primary-color); height: 4px; width: 0; position: relative; border-radius: 2px;">
											<span id="prog_valie_text_image" class="text-white"></span>
										</div>
									</div>
								</div>
							</div>

							<!-- Chat Footer -->
							<div class="chat-footer">
								<form action="<?= base_url('index.php/action/send_message') ?>" method="post" enctype="multipart/form-data"
									onsubmit="return uploadandform('<?= base_url('index.php/action/send_message') ?>','post',this,'cover_image_90_2','progress_value_image','prog_valie_text_image','Show_Errors_987','loader_post_upload','1','uni_loader_prog_status');"
									id="fomr_id_proile2">

									<div class="image-preview-container" id="imagePreviewContainer">
										<img src="" id="imagePreview" class="image-preview" />
										<button type="button" class="remove-preview" id="removeImage">&times;</button>
									</div>

									<div class="d-flex align-items-center gap-2 w-100">
										<label class="file-input-icon material-icons" title="Attach file">
											attach_file
											<input type="file" name="file_name" id="fileInput" accept="image/*" hidden>
										</label>

										<input type="text" id="message-input" name="msg" placeholder="Type a message..." autocomplete="off">

										<input type="hidden" name="chat_id" id="chat_id" value="<?= @$_GET['chat'] ?>">
										<input type="hidden" name="receiver_id" id="receiver_id" value="<?= @$_GET['user'] ?>">

										<button id="send-btn" class="material-icons" title="Send">
											send
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	// Initialize based on URL
	function initializeChatView() {
		const params = new URLSearchParams(window.location.search);
		const isMobile = window.innerWidth <= 768;
		
		if (isMobile) {
			if (params.has('chat')) {
				document.getElementById('users-list').style.display = 'none';
				document.getElementById('chat-box').style.display = 'flex';
			} else {
				document.getElementById('users-list').style.display = 'flex';
				document.getElementById('chat-box').style.display = 'none';
			}
		} else {
			// Desktop - show both
			document.getElementById('users-list').style.display = 'flex';
			document.getElementById('chat-box').style.display = 'flex';
		}
	}

	// Handle back button and URL changes
	window.addEventListener('popstate', function() {
		initializeChatView();
	});

	// Initialize on page load
	document.addEventListener('DOMContentLoaded', function() {
		initializeChatView();
		
		// Auto-scroll to bottom of chat
		const chatBody = document.getElementById('chat-body');
		if (chatBody) {
			chatBody.scrollTop = chatBody.scrollHeight;
		}
	});

	function filterUsers() {
		let input = document.getElementById("searchUser").value.toLowerCase();
		let users = document.querySelectorAll(".user");
		let noResultMessage = document.getElementById("no-users-found");
		let found = false;

		users.forEach(user => {
			let name = user.getAttribute("data-name").toLowerCase();
			if (name.includes(input)) {
				user.style.display = "flex";
				found = true;
			} else {
				user.style.display = "none";
			}
		});

		if (found) {
			noResultMessage.style.display = "none";
		} else {
			noResultMessage.style.display = "block";
		}
	}

	// Auto-refresh chat messages
	$(document).ready(function() {
		(function() {
			var f = function() {
				$('#chat-body').html($('#chat-body').html());
				var elem = document.getElementById('chat-body');
				elem.scrollTop = elem.scrollHeight;
			};
			window.setInterval(f, 30000);
			f();
		})();
	})

	function getupdate_now() {
		$('#chat-msg-container').load(document.URL + " #chat-msg-container", function() {
			setTimeout(function() {
				var elem = document.getElementById('chat-body');
				elem.scrollTop = elem.scrollHeight;
			}, 1000);
		});

		$('#message-input').val('');
		$('#removeImage').click();
	}
</script>

<script>
	document.querySelectorAll(".select-image").forEach(input => {
		input.addEventListener("change", function(event) {
			previewFile(event, "image");
		});
	});
</script>

<script>
	document.getElementById('fileInput').addEventListener('change', function(e) {
		const file = e.target.files[0];
		const preview = document.getElementById('imagePreview');
		const container = document.getElementById('imagePreviewContainer');

		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				preview.src = e.target.result;
				container.style.display = 'block';
			}
			reader.readAsDataURL(file);
		}
	});

	document.getElementById('removeImage').addEventListener('click', function() {
		const fileInput = document.getElementById('fileInput');
		const container = document.getElementById('imagePreviewContainer');

		fileInput.value = '';
		container.style.display = 'none';
	});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('fomr_id_proile2');
  const msgInput = document.getElementById('message-input');
  const fileInput = document.getElementById('fileInput');
  const removeImageBtn = document.getElementById('removeImage');
  const imagePreviewContainer = document.getElementById('imagePreviewContainer');

  form.addEventListener('submit', function(e) {
    const hasText = msgInput.value.trim() !== '';
    const hasFile = fileInput.files.length > 0;

    if (!hasText && !hasFile) {
      e.preventDefault();
      // You can show a user-friendly message if desired
      alert('Please enter a message or attach an image before sending.');
      return false;
    }

    // allow submit if either exists
  });

  // Optional: clear placeholder preview when image removed
  removeImageBtn.addEventListener('click', function() {
    imagePreviewContainer.style.display = 'none';
    fileInput.value = '';
  });
});
</script>

<!-- Before </body> -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>