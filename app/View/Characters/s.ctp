<?php
/*
 * Character Search View
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     		CJ Vogt (http://www.chrisvogt.me)
 * @link          https://github.com/chrisvogt/wowchar-info WoWChar Info
 * @package       WowCharInfo.View.Character.Search
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */ ?><div id="jumbotron" class="text-center">
				<h1>
				<img src="http://res.cloudinary.com/chrisvogt/image/upload/v1428239895/projects/wowchar/img/touch-icon-iphone.png" />
				WoW Character Viewer
				</h1>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="card hovercard">
						<div class="cardheader">
						</div>
						<div class="avatar">
							<img alt="" src="<?php echo $character['thumbnail']; ?>">
						</div>
						<div class="info">
							<div class="title">
								<h2><?php echo $character['name']; ?></h2>
							</div>
							<div class="desc"><?php echo $character['type']; ?></div>
						</div>
						<div class="share-button"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="row">
							<div class="col-md-8">
								<div class="well well-quick-stats well-trans">
								<h4>Quick Stats</h4>
								<table class="table table-responsive table-striped">
									<tr>
										<th><i class="fa fa-line-chart"></i> Level</th>
										<td><?php echo $character['level']; ?></td>
									</tr>
									<tr>
										<th><i class="fa fa-puzzle-piece"></i> Achievement Points</th>
										<td><?php echo $character['achiev_pts']; ?></td>
									</tr>
									<tr>
										<th><i class="fa fa-calendar"></i> Last Seen</th>
										<td><?php echo $this->Time->timeAgoInWords($character['last_seen']); ?></td>
									</tr>
									<tr>
										<th><i class="fa fa-map-marker"></i> Realm</th>
										<td><?php echo $character['realm']; ?></td>
									</tr>
									<tr>
										<th><i class="fa fa-globe"></i> Battlegroup</th>
										<td><?php echo $character['battlegroup']; ?></td>
									</tr>
								</table>
								</div>
							</div>
							<div class="col-md-4">
								<div class="well well-guilds">
									<h4>Links</h4>
									<a href="<?php echo $character['link']; ?>" title="Carilliya on Battle.net" class="btn btn-block btn-primary">View on Battle.NET <i class="fa fa-external-link"></i></a>
								</div>
							</div>
						</div><!-- /.row -->
					</div>
				</div>
			</div>
			<p><img class="pull-right" src="http://cakephp.org/img/default/cake-logo-smaller2.png" />Made with ♥ by <a href="https://twitter.com/c1v0">@c1v0</a>.</p>
