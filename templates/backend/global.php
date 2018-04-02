<input type="hidden" name="sid" value="<?php print $sid ?>"/>
<input type="hidden" name="action" value="config"/>
<div id="art_revolution">
    <div id="globalsettings">
        <fieldset id="global-settings" class="form-wrapper">
			<legend><span class="fieldset-legend"><div class="minus"></div><h3 class="options_heading">Global Settings</h3></span></legend>
            <div class="fieldset-wrapper">

					<div class="form-global-setting-item">
						<label>Height</label>
						<input name="startheight" class="form-text global-settings"/>
						<div class="description">This Height of the Grid where the Captions are displayed in Pixel. This Height is the Max height of Slider in Fullwidth Layout and in Responsive Layout.  In Fullscreen Layout the Gird will be centered Vertically in case the Slider is higher then this value.</div>
					</div>

					<div class="form-global-setting-item">
						<label>Full Height</label>
						<select name="fullheight" class="form-select global-settings">
							<option value="true">Yes</option>
							<option value="false">No</option>
						</select>
						<div class="description">Display full height screen of window.</div>
					</div>

          <div class="form-global-setting-item">
              <label>Effect</label>
              <select name="slider_effect" class="form-select global-settings">
                 <option value="false">Slider effect</option>
                 <option value="true">Fade effect</option>
              </select>
              <div class="description">Setting Autoplay for slider. </div>
          </div>

					<div class="form-global-setting-item">
              <label>Speed</label>
              <input name="speed" class="form-text global-settings"/>
              <div class="description">Setting speed for slider. </div>
          </div>

          <div class="form-global-setting-item">
              <label>Auto Play</label>
              <select name="autoplay" class="form-select global-settings">
                 <option value="true">Yes</option>
                 <option value="false">No</option>
              </select>
              <div class="description">Setting Autoplay for slider. </div>
          </div>

           <div class="form-global-setting-item">
              <label>Auto Play Speed</label>
              <input name="autoplay_speed" class="form-text global-settings"/>
              <div class="description">Setting Autoplay speed for slider (e.g. 7000). </div>
           </div>

           <div class="form-global-setting-item">
              <label>Pause On Hover</label>
              <select name="pause" class="form-select global-settings">
                 <option value="true">Yes</option>
                 <option value="false">No</option>
              </select>
              <div class="description">Setting Pause On Hover for slider . </div>
           </div>

           <div class="form-global-setting-item">
              <label>Display arrows</label>
              <select name="display_arrows" class="form-select global-settings">
                 <option value="true">Yes</option>
                 <option value="false">No</option>
              </select>
              <div class="description">Setting Display arrows for slider. </div>
           </div>

           <div class="form-global-setting-item">
              <label>Display dot</label>
              <select name="display_dot" class="form-select global-settings">
                 <option value="true">Yes</option>
                 <option value="false">No</option>
              </select>
              <div class="description">Setting Dot arrows for slider. </div>
           </div>

          </div>
        </fieldset>
    </div>
</div>
<div>
    <input type="button" id="save" class="form-submit" value="Save"/>
</div>

