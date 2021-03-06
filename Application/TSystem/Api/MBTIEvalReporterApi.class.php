<?php
// .-----------------------------------------------------------------------------------
// | WE TRY THE BEST WAY 杭州博也网络科技有限公司
// |-----------------------------------------------------------------------------------
// | Author: 贝贝 <hebiduhebi@163.com>
// | Copyright (c) 2013-2016, http://www.itboye.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------


namespace TSystem\Api;

class MBTIEvalReporterApi implements IEvaluationReporter{
	
	const EVAL_TYPE = 24;
	
	private $answer;
	
	private $resultDesc = array(
		'ISTJ'=>array(//1
			"严肃、安静、藉由集中心 志与全力投入、及可被信赖获致成功。",
			"行事务实、有序、实际 、 逻辑、真实及可信赖。",
			"十分留意且乐于任何事（工作、居家、生活均有良好组织及有序。",
			"负责任。",
			"照设定成效来作出决策且不畏阻挠与闲言会坚定为之。",
			"重视传统与忠诚。",
			"传统性的思考者或经理。",
		),
		'ISFJ'=>array(//2
			"安静、和善、负责任且有良心。",
			"行事尽责投入。",
			"安定性高，常居项目工作或团体之安定力量。",
			"愿投入、吃苦及力求精确。",
			"兴趣通常不在于科技方面。对细节事务有耐心。",
			"忠诚、考虑周到、知性且会关切他人感受。",
			"致力于创构有序及和谐的工作与家庭环境。",
		),
		
		'INFJ'=>array(//3
			"因为坚忍、创意及必须达成的意图而能成功。",
			"会在工作中投注最大的努力。",
			"默默强力的、诚挚的及用心的关切他人。",
			"因坚守原则而受敬重。",
			"提出造福大众利益的明确远景而为人所尊敬与追随。",
			"追求创见、关系及物质财物的意义及关联。",
			"想了解什么能激励别人及对他人具洞察力。",
			"光明正大且坚信其价值观。",
			"有组织且果断地履行其愿景。 ",
		),
		'INTJ'=>array(//4
						
			"具强大动力与本意来达成目的与创意—固执顽固者。",
			"有宏大的愿景且能快速在众多外界事件中找出有意义的模范。",
			"对所承负职务，具良好能力于策划工作并完成。",
			"具怀疑心、挑剔性、独立性、果决，对专业水准及绩效要求高。 ",
		),
		
		'ISTP'=>array(			//5
			"冷静旁观者—安静、预留余地、弹性及会以无偏见的好奇心与未预期原始的幽默观察与分析。",
			"有兴趣于探索原因及效果，技术事件是为何及如何运作且使用逻辑的原理组构事实、重视效能。",
			"擅长于掌握问题核心及找出解决方式。",
			"分析成事的缘由且能实时由大量资料中找出实际问题的核心。",
		),
		
		'ISFP'=>array(		//6	
			
			"羞怯的、安宁和善地、敏感的、亲切的、且行事谦虚。",
			"喜于避开争论，不对他人强加已见或价值观。",
			"无意于领导却常是忠诚的追随者。",
			"办事不急躁，安于现状无意于以过度的急切或努力破坏现况，且非成果导向。",
			"喜欢有自有的空间及照自订的时程办事。",
		),
		
 		
		'INFP'=>array(			//7
 
			"安静观察者，具理想性与对其价值观及重要之人具忠诚心。",
			"希外在生活形态与内在价值观相吻合。",
			"具好奇心且很快能看出机会所在。常担负开发创意的触媒者　。",
			"除非价值观受侵犯，行事会具弹性、适应力高且承受力强。",
			"具想了解及发展他人潜能的企图。想作太多且作事全神贯注　。",
			"对所处境遇及拥有不太在意。",
			"具适应力、有弹性除非价值观受到威胁。 ",
		),
		'INTP'=>array(			//8
			 
			"安静、自持、弹性及具适应力。",
			"特别喜爱追求理论与科学事理。",
			"习于以逻辑及分析来解决问题—问题解决者。",
			"最有兴趣于创意事务及特定工作，对聚会与闲聊无　大兴趣。",
			"追求可发挥个人强烈兴趣的生涯。",
			"追求发展对有兴趣事务之逻辑解释。",
		),
		'ESTP'=>array(			//9
			 
			"擅长现场实时解决问题—解决问题者。",
			"喜欢办事并乐于其中及过程。",
			"倾向于喜好技术事务及运动，交结同好友人。",
			"具适应性、容忍度、务实性；投注心力于会很快具　成效工作。",
			"不喜欢冗长概念的解释及理论。",
			"最专精于可操作、处理、分解或组合的真实事务。 ",
		),
		
		'ESFP'=>array(			//10
			"外向、和善、接受性、乐于分享喜乐予他人。",
			"与他人一起行动且促成事件发生，在学习时亦然。",
			"知晓事件未来的发展并会热列参与。",
			"最擅长于人际相处能力及具备完备常识，很有弹性能立即　适应他人与环境。",
			"对生命、人、物质享受的热爱者。",
		),
		
		'ENFP'=>array(			//11
			"充满热忱、活力充沛、聪明的、富想象力的，视生命充满机会但期能得自他人肯定与支持。",
			"几乎能达成所有有兴趣的事。",
			"对难题很快就有对策并能对有困难的人施予援手。",
			"依赖能改善的能力而无须预作规划准备。",
			"为达目的常能找出强制自己为之的理由。",
			"即兴执行者。",
		),
		
		'ENTP'=>array(			//12
			"反应快、聪明、长于多样事务。",
			"具激励伙伴、敏捷及直言讳专长。",
			"会为了有趣对问题的两面加予争辩。",
			"对解决新及挑战性的问题富有策略，但会轻忽或厌烦经常的任务与细节。",
			"兴趣多元，易倾向于转移至新生的兴趣。",
			"对所想要的会有技巧地找出逻辑的理由。",
			"长于看清础他人，有智能去解决新或有挑战的问题 ",
		),
		
		'ESTJ'=>array(			//13
			"务实、真实、事实倾向，具企业或技术天份。",
			"不喜欢抽象理论；最喜欢学习可立即运用事理。",
			"喜好组织与管理活动且专注以最有效率方式行事以达致成效。",
			"具决断力、关注细节且很快作出决策—优秀行政者。",
			"会忽略他人感受。",
			"喜作领导者或企业主管。 ",
		),
		
		'ESFJ'=>array(			//14
			 
			"诚挚、爱说话、合作性高、受　欢迎、光明正大 的—天生的　合作者及活跃的组织成员。 ",
			"重和谐且长于创造和谐。 ",
			"常作对他人有益事务。 ",
			"给予鼓励及称许会有更佳工作成效。 ",
			"最有兴趣于会直接及有形影响人们生活的事务。 ",
			"喜欢与他人共事去精确且准时地完成工作。 ",
		),
		
		'ENFJ'=>array(			//15
			"热忱、易感应及负责任的--具能鼓励他人的领导风格。",
			"别人所想或希求会表达真正关切且切实用心去处理。",
			"能怡然且技巧性地带领团体讨论或演示文稿提案。",
			"爱交际、受欢迎及富同情心。",
			"对称许及批评很在意。",
			"喜欢带引别人且能使别人或团体发挥潜能。",
		),
		
		'ENTJ'=>array(			//16
			"坦诚、具决策力的活动领导者。",
			"长于发展与实施广泛的系统以解决组织的问题。",
			"专精于具内涵与智能的谈话如对公众演讲。",
			"乐于经常吸收新知且能广开信息管道。",
			"易生过度自信，会强于表达自已创见。",
			"喜于长程策划及目标设定 ",
		),
		

		
	);
	
	public function generate($params){
		
		if(!is_array($params) || !isset($params['id'])){
			trigger_error("缺少参数ID!");
		}
		
		$map = array(
			'id'=>$params['id'],
		);
		
		$result = apiCall("TSystem/TestevalUserAnswer/getInfo", array($map));
		if(!$result['status']){
			return $this->returnErr($result['info']);
		}
		$entity = $result['info'];//取得用户选择的答案
		$this->answer = unserialize($entity['answer']);
		//答案需要包含信息
		//1. 问题编号
		//2. 答案编号，答案隐藏值,
		//========================进行MBTI量表的分析并生成相应数据======
		$result = array(
			'score'=>'',
			'code'=>'',
			'desc'=>'',
		);
		
		$score = $this->getESTJINFP();
		$code = "";
		if($score['E'] > $score['I']){
			$score['EI'] = array('left', number_format(100.0 * ($score['E'] - $score['I']) / ($score['E'] + $score['I']) ,2));
			$code .= "E";
		}else{
			$code .= "I";
			$score['EI'] = array('right', number_format(100.0 * ($score['I'] - $score['E']) / ($score['I'] + $score['E']),2));
		}
		
		if($score['S'] > $score['N']){
			$score['SN'] = array('left', number_format(100.0 * ($score['S'] - $score['N']) / ($score['S'] + $score['N']),2));
			$code .= "S";
		}else{
			$score['SN'] = array('right', number_format(100.0 * ($score['N'] - $score['S']) / ($score['N'] + $score['S']),2));
			$code .= "N";
		}
		
		if($score['T'] > $score['F']){
			$score['TF'] = array('left', number_format(100.0 * ($score['T'] - $score['F']) / ($score['F'] + $score['T']),2));
			$code .= "T";
		}else{
			$score['TF'] = array('right', number_format(100.0 * ($score['F'] - $score['T']) / ($score['F'] + $score['T']),2));
			$code .= "F";
		}
		
		if($score['J'] > $score['P']){
			$score['JP'] =	array('left', number_format(100.0 * ($score['J'] - $score['P']) / ($score['J'] + $score['P']),2));
			$code .= "J";
		}else{
			$score['JP'] = array('right',number_format(100.0 * ($score['P'] - $score['J']) / ($score['J'] + $score['P']),2));
			$code .= "P";
		}
		
		$result['score'] = $score;
		$result['code'] = $code;
		$result['desc'] = $this->resultDesc[$code];
//		dump($this->answer);
//		dump($result);
		
		
		//============================================================
		return $this->returnSuc($result);
	}
	
	
	public function getData($params){
		
		if(!is_array($params) || !isset($params['id'])){
			trigger_error("缺少参数ID!");
		}
		
		$id = $params['id'];
		$map = array(
			'id'=>$id,
		);
		
		$result = apiCall("TSystem/TestevalUserResult/getInfo",array($map));
		
		if(!$result['status']){
			$this->error($result['info']);
		}
		
		if(is_null($result['info'])){
			return $this->returnErr("ID参数错误!");
		}
		
		$result['info']['_data'] = unserialize($result['info']['result']);
		
		return $this->returnSuc($result['info']);
	}
	
	/**
	 * 获取解决方案、治疗方案
	 */
	public function getSolution($params){
		
		
		
	}
	
	
	
	
	
	
	
	//======================================私有方法
	
	
	private function getESTJINFP(){
		/**
		 * E 外向 I 内向
		 * S 实感 N 直感
		 * T 思考 F 情感
		 * J 判断 p 认知
		 */
		$score = array(
			'E'=>0,'I'=>0,
			'S'=>0,'N'=>0,
			'T'=>0,'F'=>0,
			'J'=>0,'P'=>0,
		);
		foreach($this->answer as $vo){
			//
			$ans = $vo['ans'];
			$score[strtoupper($ans['hidden_value'])]++; 
			
		}
		
		return $score;
		
	}
	
	
	private function returnErr($info){
		return array('status'=>false,'info'=>$info);
	}
	
	private function returnSuc($info){
		return array('status'=>true,'info'=>$info);
	}
}
